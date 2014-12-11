<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'] = [
    ['label' => 'Accounts', 'url' => ['account/index']],
    ['label' => $account->Name, 'url' => ['envelope/index', 'accountId' => $envelope->AccountId]],
    ['label' => $envelope->Name],
];
?>
<?php $this->beginBlock('main-content'); ?>
<div class="transaction-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaction', ['create', 'envelopeId' => $envelope->Id], ['class' => 'btn btn-success showDialog', 'title' => 'Create Transaction']) ?>
    </p>
<?php
   
$actionCol = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}{update}{delete}{pending}',
    'buttons' => 
        [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class' => 'showDialog'
                ]);
            },
            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'class' => 'showDialog'
                ]);
            },
            'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                        'data-method' => 'post',
                ]);
            },
            'pending' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, [
                            'title' => Yii::t('app', 'Pending'),
                ]);
            }
        ],
    'urlCreator' => function ($action, $model, $key, $index) {
        if ($action === 'view') {
           $url = yii\helpers\Url::to(['transaction/view', 'id' => $model->Id]);
            return $url;
        }
        elseif ($action === 'update') {
           $url = yii\helpers\Url::to(['transaction/update', 'id' => $model->Id]);
            return $url;
        }
        elseif ($action === 'delete') {
           $url = yii\helpers\Url::to(['transaction/delete', 'id' => $model->Id]);
            return $url;
        }
        elseif ($action === 'pending') {
           $url = yii\helpers\Url::to(['transaction/move-pending', 'id' => $model->Id]);
            return $url;
        }
    }
];
?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => //$gridColumns,
        [
            ['class' => '\kartik\grid\SerialColumn', 'visible' => false],
            'Name',
            'PostedDate',
            'Amount',
            'Pending',
            ['attribute' => 'UseInStats', 'class' => '\kartik\grid\BooleanColumn'],
            ['attribute' => 'IsRefund', 'class' => '\kartik\grid\BooleanColumn'],
            $actionCol,
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'export' => false,
        'bootstrap' => true
    ]);
    ?>

</div>
<?php $this->endBlock(); ?>
