<?php

namespace app\controllers;

use Yii;
use app\models\Transaction;
use app\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

    public function actionCreateForSum($accountId, $amount) {
        $account = AccountController::findModelPlus($accountId);

        $model = new Transaction();
        $model->Amount = $amount;
        $model->CreatedBy = 1;
        $model->ModifiedBy = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'envelopeId' => $model->EnvelopeId]);
        } else {
            if (Yii::$app->request->getIsAjax()) {
                $this->layout = 'dialog';
            }

            return $this->render('create', [
                        'model' => $model,
                        'envelope' => null,
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

        $model->ModifiedBy = 1;
        $model->ModifiedOn = date('Y-m-d H:i:s');

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

        $this->DeleteTransaction($id);

        return $this->redirect(['index', 'envelopeId' => $envelopeId]);
    }

    public function DeleteTransaction($id) {        
        $model = Transaction::findOne($id);

        $model->IsDeleted = 1;
        $model->ModifiedBy = 1;
        $model->ModifiedOn = date('Y-m-d H:i:s');

        return $model->save();
    }

    public function actionMovePending($id, $postBack) {
        $model = $this->findModel($id);

        if ($model->Pending != 0) {
            $model->Amount = $model->Pending;
            $model->Pending = null;
            $model->ModifiedBy = 1;
            $model->ModifiedOn = date('Y-m-d H:i:s');

            $model->save();
        }

        if ($postBack === "envelope") {
            $envelope = EnvelopeController::findModel($model->EnvelopeId);

            return $this->redirect(['envelope/index', 'accountId' => $envelope->AccountId]);
        } else {
            return $this->redirect(['index', 'envelopeId' => $model->EnvelopeId]);
        }
    }

    public function actionTransfer() {
        $model1 = new Transaction();
        $model1->CreatedBy = 1;
        $model1->ModifiedBy = 1;
        $model1->UseInStats = 0;

        $model2 = new Transaction();
        $model2->CreatedBy = 1;
        $model2->ModifiedBy = 1;
        $model2->UseInStats = 0;

        $transactions = array();
        array_push($transactions, $model1, $model2);

        if (Transaction::loadMultiple($transactions, Yii::$app->request->post())) {
            $e = EnvelopeController::findModel($transactions[0]->EnvelopeId);
            $a = AccountController::findModel($e->AccountId);

            $transactions[1]->Amount = $transactions[0]->Amount;
            $transactions[1]->Pending = $transactions[0]->Pending;
            $transactions[1]->Name = "TrxF " . $a->Name . " - " . $e->Name . " " . $transactions[0]->Name;
            $transactions[1]->PostedDate = $transactions[0]->PostedDate;

            $e = EnvelopeController::findModel($transactions[1]->EnvelopeId);
            $a = AccountController::findModel($e->AccountId);

            $transactions[0]->Amount === "" ? $transactions[0]->Amount : $transactions[0]->Amount = $transactions[0]->Amount * -1;
            $transactions[0]->Pending === "" ? $transactions[0]->Pending : $transactions[0]->Pending = $transactions[0]->Pending * -1;
            $transactions[0]->Name = "TrxT " . $a->Name . " - " . $e->Name . " " . $transactions[0]->Name;

            foreach ($transactions as $transaction) {
                $transaction->save(false);
            }

            return $this->redirect(['envelope/index', 'accountId' => $a->Id]);
        }

        if (Yii::$app->request->getIsAjax()) {
            $this->layout = 'dialog';
        }

        return $this->render('transfer', ['transactions' => $transactions]);
    }

    public function actionAddPaycheck($accountId) {
        $account = AccountController::findModel($accountId);

        $transactions = $this->GetTransactionsForPaycheck($accountId);
        $envelopes = EnvelopeController::GetEnvelopesPlus($accountId);

        if (Transaction::loadMultiple($transactions, Yii::$app->request->post())) {
            foreach ($transactions as $transaction) {
                $transaction->Name = $transactions[0]->Name;
                $transaction->PostedDate = $transactions[0]->PostedDate;

                if ($transaction->Amount != 0 || $transaction->Pending != 0) {
                    $transaction->save(false);
                } else {
                    $transaction->delete();
                }
            }

            return $this->redirect(['envelope/index', 'accountId' => $accountId]);
        }

        return $this->render('add-paycheck', ['account' => $account, 'envelopes' => $envelopes, 'transactions' => $transactions]);
    }

    private function GetTransactionsForPaycheck($accountId) {
        $envelopes = EnvelopeController::GetEnvelopes($accountId);

        $transactions = array();
        foreach ($envelopes as $e) {
            $t = new Transaction();
            $t->CreatedBy = 1;
            $t->ModifiedBy = 1;
            $t->EnvelopeId = $e->Id;

            array_push($transactions, $t);
        }

        return $transactions;
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
