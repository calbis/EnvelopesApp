<?php

namespace app\controllers;

use Yii;
use app\models\Envelope;
use app\models\EnvelopeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnvelopeController implements the CRUD actions for Envelope model.
 */
class EnvelopeController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Envelope models.
     * @return mixed
     */
    public function actionSearchIndex() {
        $searchModel = new EnvelopeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex($accountId) {
        $account = AccountController::findModelPlus($accountId);

        $query = Envelope::find();

        $envelopes = $query->select('Id, Name, Color')
                ->where([
                    'IsDeleted' => 0,
                    'IsClosed' => 0,
                    'AccountId' => $accountId,
                ])
                ->orderBy('Name')
                ->limit(100)
                ->joinWith('vwEnvelopeSum')
                ->all();
//        BaseVarDumper::dump($accounts);

        return $this->render('index', [
                    'envelopes' => $envelopes,
                    'account' => $account,
        ]);
    }

    /**
     * Displays a single Envelope model.
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
     * Creates a new Envelope model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($accountId) {
        $model = new Envelope();
        $model->AccountId = $accountId;
        $model->CreatedBy = 1;
        $model->ModifiedBy = 1;
        $currDate = date('Y-m-d H:i:s');
        $model->CreatedOn = $currDate;
        $model->ModifiedOn = $currDate;
        $model->IsClosed = 0;
        $model->IsDeleted = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'accountId' => $model->AccountId]);
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
     * Updates an existing Envelope model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'accountId' => $model->AccountId]);
        } else {
            if (Yii::$app->request->getIsAjax()) {
                $this->layout = 'dialog';
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Envelope model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $accountId = $this->findModel($id)->AccountId;
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'accountId' => $accountId]);
    }

    /**
     * Finds the Envelope model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Envelope the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Envelope::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findModelPlus($id) {
        $query = Envelope::find();

        $envelope = $query->select('Id, AccountId, Name, Color')
                ->where([
                    'Id' => $id,
                ])
                ->joinWith('vwEnvelopeSum')
                ->one();
        
        return $envelope;
    }

}
