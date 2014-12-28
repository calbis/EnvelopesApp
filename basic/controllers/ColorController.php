<?php

namespace app\controllers;

use Yii;
use app\models\Color;
use app\models\ColorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ColorController implements the CRUD actions for Color model.
 */
class ColorController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Color models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ColorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Color model.
     * @param string $Id
     * @param string $Name
     * @return mixed
     */
    public function actionView($Id, $Name)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id, $Name),
        ]);
    }

    /**
     * Creates a new Color model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Color();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id' => $model->Id, 'Name' => $model->Name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Color model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $Id
     * @param string $Name
     * @return mixed
     */
    public function actionUpdate($Id, $Name)
    {
        $model = $this->findModel($Id, $Name);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id' => $model->Id, 'Name' => $model->Name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Color model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $Id
     * @param string $Name
     * @return mixed
     */
    public function actionDelete($Id, $Name)
    {
        $this->findModel($Id, $Name)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Color model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $Id
     * @param string $Name
     * @return Color the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id, $Name)
    {
        if (($model = Color::findOne(['Id' => $Id, 'Name' => $Name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
