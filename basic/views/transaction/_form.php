<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\EnvelopeSearch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    Html::activeDropDownList($model, 'EnvelopeId', ArrayHelper::map(EnvelopeSearch::findForDDL($account->Id) , 'Id', 'Name'))
    ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => 255, 'class' => 'formControl']) ?>

    <?= $form->field($model, 'PostedDate')->textInput(['class' => 'datePicker']) ?>

    <?= $form->field($model, 'Amount')->textInput(['maxlength' => 19, 'class' => 'formControl']) ?>

    <?= $form->field($model, 'Pending')->textInput(['maxlength' => 19, 'class' => 'formControl']) ?>

    <?= $form->field($model, 'UseInStats')->textInput(['class' => 'formControl']) ?>

    <?= $form->field($model, 'IsRefund')->textInput(['class' => 'formControl']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
