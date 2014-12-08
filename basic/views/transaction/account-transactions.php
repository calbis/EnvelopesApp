<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';

?>
<div class="transaction-index">
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
            ['class' => '\kartik\grid\ActionColumn'],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'export' => false,
        'bootstrap' => true
    ]);
    ?>
</div>
