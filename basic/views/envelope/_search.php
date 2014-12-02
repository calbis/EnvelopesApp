<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EnvelopeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="envelope-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'AccountId') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'Color') ?>

    <?= $form->field($model, 'CalculationType') ?>

    <?php // echo $form->field($model, 'CalculationAmount') ?>

    <?php // echo $form->field($model, 'IsClosed') ?>

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
