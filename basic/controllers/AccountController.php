<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Account;

class AccountController extends Controller
{
    public $layout = 'main';
    
    public function actionIndex()
    {
        $query = Account::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $accounts = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'accounts' => $accounts,
            'pagination' => $pagination,
        ]);
    }
}