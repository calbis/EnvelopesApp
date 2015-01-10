<?php

namespace app\controllers;

use Yii;
use app\models\Envelope;
use app\models\EnvelopeSearch;
use app\models\TransactionSearch;
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
//                    'delete' => ['get'],
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

        $envelopes = $this->GetEnvelopesPlus($accountId);

        //\yii\helpers\VarDumper::dump($envelopes);
        
        $at = $this->AccountTransactions($accountId);
        $pt = $this->PendingTransactions($accountId);

        return $this->render('index', [
                    'envelopes' => $envelopes,
                    'account' => $account,
                    'atSearchModel' => $at['searchModel'],
                    'atDataProvider' => $at['dataProvider'],
                    'pendingTransactions' => $pt
        ]);
    }

    public function actionBulkMovePending($accountId, $type, $value) {
        if ($type === "date") {
            $this->BulkMovePending($accountId, "PostedDate", $value);
        } elseif ($type === "name") {
            $this->BulkMovePending($accountId, "Name", $value);
        }

        return $this->redirect(['envelope/index', 'accountId' => $accountId]);
    }

    private function BulkMovePending($accountId, $column, $value) {
        $trans = TransactionSearch::findForBulkPending($accountId, $column, $value);

        foreach ($trans as $t) {
            $t->Amount = $t->Pending;
            $t->Pending = NULL;
            $t->ModifiedOn = date('Y-m-d H:i:s');
            $t->ModifiedBy = 1;

            $t->save();
        }
    }

    private function PendingTransactions($accountId) {
        $pt = [];

        $trans = TransactionSearch::findByName($accountId);
        foreach ($trans as $t) {
            array_push($pt, ['type' => 'name', 'value' => $t->Name, 'pending' => $t->Pending]);
        }

        $trans = TransactionSearch::findByDate($accountId);
        foreach ($trans as $t) {
            array_push($pt, ['type' => 'date', 'value' => $t->PostedDate, 'pending' => $t->Pending]);
        }

        return $pt;
    }

    public function GetEnvelopes($accountId) {
        $query = Envelope::find();

        return $query->select('Id, Name, Color')
                        ->where([
                            'IsDeleted' => 0,
                            'IsClosed' => 0,
                            'AccountId' => $accountId,
                        ])
                        ->orderBy('Name')
                        ->limit(100)
                        ->joinWith('vwEnvelopeSum')
                        ->all();
    }

    public function GetEnvelopesPlus($accountId) {
        $query = (new \yii\db\Query());

        return $query->select('Id, Name, Color, EnvelopeSum, EnvelopePending, StatsCost, TimeLeft, GoalDeposit')
                        ->from('envelope E')
                        ->where([
                            'IsDeleted' => 0,
                            'IsClosed' => 0,
                            'AccountId' => $accountId,
                        ])
                        ->orderBy('Name')
                        ->limit(100)
                        ->leftJoin('vw_envelope_sum ES', 'E.Id = ES.EnvelopeId')
                        ->all();
    }

    protected function AccountTransactions($accountId) {
        $envelopeIds = EnvelopeSearch::GetEnvelopeIdsByAccount($accountId);

        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $envelopeIds, null);

        return [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];
    }

    /**
     * Displays a single Envelope model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = EnvelopeController::findModel($id);
        $account = AccountController::findModel($model->AccountId);

        if (Yii::$app->request->getIsAjax()) {
            $this->layout = 'dialog';
        }

        return $this->render('view', [
                    'model' => $model,
                    'account' => $account,
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
            $account = AccountController::findModel($accountId);

            if (Yii::$app->request->getIsAjax()) {
                $this->layout = 'dialog';
            }

            return $this->render('create', [
                        'model' => $model,
                        'account' => $account,
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
        $model = EnvelopeController::findModel($id);

        $model->ModifiedBy = 1;
        $model->ModifiedOn = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelPlus = $this->findModelPlus($id);
            if ($modelPlus->vwEnvelopeSum->EnvelopeSum != 0 || $modelPlus->vwEnvelopeSum->EnvelopePending != 0) {
                $model->IsClosed = 0;
                $model->save();
            }

            return $this->redirect(['index', 'accountId' => $model->AccountId]);
        } else {
            $account = AccountController::findModel($model->AccountId);

            if (Yii::$app->request->getIsAjax()) {
                $this->layout = 'dialog';
            }

            return $this->render('update', [
                        'model' => $model,
                        'account' => $account,
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
        $modelPlus = EnvelopeController::findModelPlus($id);

        if ($modelPlus->vwEnvelopeSum->EnvelopeSum == 0 && $modelPlus->vwEnvelopeSum->EnvelopePending == 0) {
            $this->DeleteEnvelope($id);
        }

        return $this->redirect(['index', 'accountId' => $modelPlus->AccountId]);
    }

    public function DeleteEnvelope($envelopeId) {
        $this->DeleteTransactions($envelopeId);

        $model = Envelope::findOne($envelopeId);
        $model->IsDeleted = 1;
        $model->ModifiedBy = 1;
        $model->ModifiedOn = date('Y-m-d H:i:s');

        $model->save();
    }

    private function DeleteTransactions($envelopeId) {
        $trans = TransactionSearch::findByEnvelope($envelopeId);

        foreach ($trans as $t) {
            TransactionController::DeleteTransaction($t->Id);
        }
    }

    /**
     * Finds the Envelope model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Envelope the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id) {
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
