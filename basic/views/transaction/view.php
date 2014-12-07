<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'] = [
    ['label' => 'Accounts', 'url' => ['account/index']],
    ['label' => $account->Name, 'url' => ['envelope/index', 'accountId' => $envelope->AccountId]],
    ['label' => $envelope->Name, 'url' => ['transaction/index', 'envelopeId' => $envelope->Id]],
    ['label' => $this->title],
];
?>
<?php $this->beginBlock('main-content'); ?>
<div class="transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'EnvelopeId',
            'Name',
            'PostedDate',
            'Amount',
            'Pending',
            'UseInStats',
            'IsRefund',
            'CreatedOn',
            'CreatedBy',
            'ModifiedOn',
            'ModifiedBy',
            'IsDeleted',
        ],
    ]) ?>
</div>
<?php $this->endBlock(); ?>
