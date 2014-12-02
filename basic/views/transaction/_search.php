<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'EnvelopeId') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'PostedDate') ?>

    <?= $form->field($model, 'Amount') ?>

    <?php // echo $form->field($model, 'Pending') ?>

    <?php // echo $form->field($model, 'UseInStats') ?>

    <?php // echo $form->field($model, 'IsRefund') ?>

    <?php // echo $form->field($model, 'CreatedOn') ?>

    <?php // echo $form->field($model, 'CreatedBy') ?>

    <?php // echo $form->field($model, 'ModifiedOn') ?>

    <?php // echo $form->field($model, 'ModifiedBy') ?>

    <?php // echo $form->field($model, 'IsDeleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
