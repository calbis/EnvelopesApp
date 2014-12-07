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
<h2 class="<?= $account->Color ?>"><?= Html::a($account->Name, ['envelope/index', 'accountId' => $account->Id], ['class' => '', 'title' => $account->Name]) ?></h2>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaction', ['create', 'envelopeId' => $envelope->Id], ['class' => 'btn btn-success showDialog', 'title' => 'Create Transaction']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => //$gridColumns,
        [
            'Name',
            'PostedDate',
            'Amount',
            'Pending',
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
