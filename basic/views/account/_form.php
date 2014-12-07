<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'Color')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'IsCash')->textInput() ?>

    <?= $form->field($model, 'IsClosed')->textInput() ?>

    <?= $form->field($model, 'ExternalTotal')->textInput(['maxlength' => 19]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
