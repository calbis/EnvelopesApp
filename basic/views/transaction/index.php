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

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => //$gridColumns,
        [
            ['class' => 'yii\grid\SerialColumn'],
            'Name',
            'PostedDate',
            'Amount',
            'Pending',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive' => true,
        'hover' => true
    ]);
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            //'Id',
//            'EnvelopeId',
//            'Name',
//            'PostedDate',
//            'Amount',
//             'Pending',
//            // 'UseInStats',
//            // 'IsRefund',
//            // 'CreatedOn',
//            // 'CreatedBy',
//            // 'ModifiedOn',
//            // 'ModifiedBy',
//            // 'IsDeleted',
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);
    ?>

</div>
<?php $this->endBlock(); ?>
