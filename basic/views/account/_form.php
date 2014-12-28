<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ColorSearch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => 255]) ?>

    <?=
    Html::activeDropDownList($model, 'Color', ArrayHelper::map(ColorSearch::findForDDL(), 'Id', 'Name'))
    ?>

    <?= $form->field($model, 'IsCash')->checkBox() ?>

    <?= $form->field($model, 'IsClosed')->checkBox() ?>

    <?= $form->field($model, 'ExternalTotal')->textInput(['maxlength' => 19]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
