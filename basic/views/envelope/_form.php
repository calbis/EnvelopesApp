<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AccountSearch;
use app\models\ColorSearch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Envelope */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="envelope-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    Html::activeDropDownList($model, 'AccountId', ArrayHelper::map(AccountSearch::findForDDL(), 'Id', 'Name'))
    ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => 255]) ?>

    <?=
    Html::activeDropDownList($model, 'Color', ArrayHelper::map(ColorSearch::findForDDL(), 'Id', 'Name'))
    ?>

    <?= $form->field($model, 'CalculationType')->dropDownList(['var' => 'Variable', 'fix' => 'Fixed']) ?>

    <?= $form->field($model, 'CalculationAmount')->textInput() ?>

    <?= $form->field($model, 'IsClosed')->checkBox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
