<?php

namespace app\controllers;

use Yii;
use app\models\Account;
//use app\models\AccountSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseVarDumper;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller {

    public $layout = 'main';

//    public function behaviors() {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['post'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex() {

//        $searchModel = new AccountSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//        ]);

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
//        BaseVarDumper::dump($accounts);

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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
