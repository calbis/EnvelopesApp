<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EnvelopeId')->textInput() ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'PostedDate')->textInput() ?>

    <?= $form->field($model, 'Amount')->textInput(['maxlength' => 19]) ?>

    <?= $form->field($model, 'Pending')->textInput(['maxlength' => 19]) ?>

    <?= $form->field($model, 'UseInStats')->textInput() ?>

    <?= $form->field($model, 'IsRefund')->textInput() ?>

    <?= $form->field($model, 'CreatedOn')->textInput() ?>

    <?= $form->field($model, 'CreatedBy')->textInput() ?>

    <?= $form->field($model, 'ModifiedOn')->textInput() ?>

    <?= $form->field($model, 'ModifiedBy')->textInput() ?>

    <?= $form->field($model, 'IsDeleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
