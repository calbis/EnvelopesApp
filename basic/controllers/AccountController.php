<?php

namespace app\controllers;

use Yii;
use app\models\Account;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller {

    public $layout = 'main';

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex() {
        $query = Account::find();

        $pagination = new Pagination([
            'defaultPageSize' => 100,
            'totalCount' => $query->count(),
        ]);

        $accounts = $query->select('Id, Name, Color, ExternalTotal')
                ->where([
                    'IsDeleted' => 0,
                    'IsClosed' => 0,
                ])
                ->orderBy('name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->joinWith('vwAccountSum')
                ->all();

        return $this->render('index', [
                    'accounts' => $accounts,
                    'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->request->getIsAjax()) {
            $this->layout = 'dialog';
        }
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Account();
        $model->CreatedBy = 1;
        $model->ModifiedBy = 1;
        $currDate = date('Y-m-d H:i:s');
        $model->CreatedOn = $currDate;
        $model->ModifiedOn = $currDate;
        $model->IsClosed = 0;
        $model->IsDeleted = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            if (Yii::$app->request->getIsAjax()) {
                $this->layout = 'dialog';
            }
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = AccountController::findModel($id);

        $model->ModifiedBy = 1;
        $model->ModifiedOn = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelPlus = $this->findModelPlus($id);
            if ($modelPlus->vwAccountSum->AccountSum != 0 || $modelPlus->vwAccountSum->AccountPending != 0) {
                $model->IsClosed = 0;
                $model->save();
            }

            return $this->redirect(['index']);
        } else {
            if (Yii::$app->request->getIsAjax()) {
                $this->layout = 'dialog';
            }
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCalculate($Id, $ExternalTotal) {
        $model = AccountController::findModel($Id);

        $model->ModifiedBy = 1;
        $model->ModifiedOn = date('Y-m-d H:i:s');
        $model->ExternalTotal = $ExternalTotal;

        $model->save();

        return $this->redirect(['/envelope/index', 'accountId' => $Id]);
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $modelPlus = AccountController::findModelPlus($id);
        if ($modelPlus->vwAccountSum->AccountSum == 0 && $modelPlus->vwAccountSum->AccountPending == 0) {
            $this->DeleteEnvelopes($id);

            $model = $this->findModel($id);
            $model->IsDeleted = 1;
            $model->ModifiedBy = 1;
            $model->ModifiedOn = date('Y-m-d H:i:s');

            $model->save();
        }

        return $this->redirect(['index']);
    }

    private function DeleteEnvelopes($accountId) {
        $envs = \app\models\EnvelopeSearch::findByAccount($accountId);

        foreach ($envs as $e) {
            EnvelopeController::DeleteEnvelope($e->Id);
        }
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id) {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findModelPlus($id) {
        $query = Account::find();

        $account = $query->select('Id, Name, Color, ExternalTotal')
                ->where([
                    'Id' => $id,
                ])
                ->joinWith('vwAccountSum')
                ->one();

        return $account;
    }

}
