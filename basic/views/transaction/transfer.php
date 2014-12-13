<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\EnvelopeSearch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'Transfer Money';
$this->params['breadcrumbs'] = [
    ['label' => 'Accounts', 'url' => ['account/index']],
    ['label' => $this->title],
];
?>
<?php $this->beginBlock('main-content'); ?>
<div class="transaction-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="transaction-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'Amount')->textInput(['maxlength' => 19, 'class' => 'formControl']) ?>

        <?= $form->field($model, 'Pending')->textInput(['maxlength' => 19, 'class' => 'formControl']) ?>
        
        <label for="EnvelopeIdFrom">
            <?=
            Html::activeDropDownList($model, 'EnvelopeIdFrom', ArrayHelper::map(EnvelopeSearch::findForTransferDDL(), 'Id', 'ExtName'))
            ?>
        </label>
        <label for="EnvelopeIdTo">
            <?=
            Html::activeDropDownList($model, 'EnvelopeIdTo', ArrayHelper::map(EnvelopeSearch::findForTransferDDL(), 'Id', 'ExtName'))
            ?>
        </label>
        <?= $form->field($model, 'Name')->textInput(['maxlength' => 255, 'class' => 'formControl'])->label('Optional Name') ?>

        <?= $form->field($model, 'PostedDate')->textInput(['class' => 'datePicker']) ?>

        <div class="form-group">
            <?= Html::submitButton('Transfer', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
<?php $this->endBlock(); ?>
