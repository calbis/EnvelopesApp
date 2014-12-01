<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Account;
use yii\helpers\BaseVarDumper;

class AccountController extends Controller {

    public $layout = 'main';

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
//        BaseVarDumper::dump($accounts);

        return $this->render('index', [
                    'accounts' => $accounts,
                    'pagination' => $pagination,
        ]);
    }

}
