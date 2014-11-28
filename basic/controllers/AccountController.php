<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Account;

class AccountController extends Controller {

    public $layout = 'main';

    public function actionIndex() {
        $query = Account::find();

        $pagination = new Pagination([
            'defaultPageSize' => 100,
            'totalCount' => $query->count(),
        ]);

        $accounts = $query->select('Id, Name, Color, ExternalTotal, AccountSum, AccountPending')
                ->where([
                    'IsDeleted' => 0,
                    'IsClosed' => 0,
                ])
                ->leftJoin('vwAccountSum VWAS', 'account.Id = VWAS.AccountId')
                ->orderBy('name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();


        return $this->render('index', [
                    'accounts' => $accounts,
                    'pagination' => $pagination,
        ]);
    }

}
