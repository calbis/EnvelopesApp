<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Envelope */

$this->title = 'Update Envelope: ' . ' ' . $model->Name;
$this->params['breadcrumbs'] = [
    ['label' => 'Accounts', 'url' => ['account/index']],
    ['label' => $account->Name],
];
?>
<?php $this->beginBlock('main-content'); ?>
<div class="envelope-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
<?php $this->endBlock(); ?>
