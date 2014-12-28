<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Color */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="color-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
