<?php

namespace app\controllers;

use Yii;
use app\models\Transaction;
use app\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Envelope;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller {

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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex($envelopeId) {
        $envelope = EnvelopeController::findModelPlus($envelopeId);
        $account = AccountController::findModelPlus($envelope->AccountId);

        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $envelopeId, null);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'envelope' => $envelope,
                    'account' => $account,
        ]);
    }

    public function actionAccountTransactions($accountId) {
        $query = Envelope::find();
        $envelopes = $query->select('Id')
                ->where([
                    'IsDeleted' => 0,
                    'IsClosed' => 0,
                    'AccountId' => $accountId,
                ])
                ->limit(100)
                ->all();
        
        $envelope = null;
        $envelopeIds = [];
        foreach($envelopes as $envelope) {
            array_push($envelopeIds, $envelope->Id);
        }

        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $envelopeIds, 45);

        return $this->render('account-transactions', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $envelope = EnvelopeController::findModelPlus($model->EnvelopeId);
        $account = AccountController::findModelPlus($envelope->AccountId);

        if (Yii::$app->request->getIsAjax()) {
            $this->layout = 'dialog';
        }

        return $this->render('view', [
                    'model' => $model,
                    'envelope' => $envelope,
                    'account' => $account,
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($envelopeId) {
        $envelope = EnvelopeController::findModelPlus($envelopeId);
        $account = AccountController::findModelPlus($envelope->AccountId);

        $model = new Transaction();
        $model->EnvelopeId = $envelopeId;
        $model->CreatedBy = 1;
        $model->ModifiedBy = 1;
        $currDate = date('Y-m-d H:i:s');
        $model->CreatedOn = $currDate;
        $model->ModifiedOn = $currDate;
        $model->IsDeleted = 0;
        $model->IsRefund = 0;
        $model->UseInStats = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'envelopeId' => $model->EnvelopeId]);
        } else {
            if (Yii::$app->request->getIsAjax()) {
                $this->layout = 'dialog';
            }

            return $this->render('create', [
                        'model' => $model,
                        'envelope' => $envelope,
                        'account' => $account,
            ]);
        }
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $envelope = EnvelopeController::findModelPlus($model->EnvelopeId);
        $account = AccountController::findModelPlus($envelope->AccountId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'envelopeId' => $model->EnvelopeId]);
        } else {
            if (Yii::$app->request->getIsAjax()) {
                $this->layout = 'dialog';
            }

            return $this->render('update', [
                        'model' => $model,
                        'envelope' => $envelope,
                        'account' => $account,
            ]);
        }
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $envelopeId = $this->findModel($id)->EnvelopeId;
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'envelopeId' => $envelopeId]);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
