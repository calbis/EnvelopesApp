<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'Update Transaction: ' . ' ' . $model->Name;
$this->params['breadcrumbs'] = [
    ['label' => 'Accounts', 'url' => ['account/index']],
    ['label' => $account->Name, 'url' => ['envelope/index', 'accountId' => $envelope->AccountId]],
    ['label' => $envelope->Name, 'url' => ['transaction/index', 'envelopeId' => $envelope->Id]],
    ['label' => $this->title],
];
?>
<?php $this->beginBlock('main-content'); ?>
<div class="transaction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'account' => $account,
    ]) ?>
</div>
<?php $this->endBlock(); ?>
