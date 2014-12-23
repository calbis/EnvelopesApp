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

        <?= $form->field($transactions[0], '[0]Amount')->textInput(['maxlength' => 19, 'class' => 'formControl']) ?>

        <?= $form->field($transactions[0], '[0]Pending')->textInput(['maxlength' => 19, 'class' => 'formControl']) ?>
        <p>
            <label for="EnvelopeId">From: </label>
            <?=
            Html::activeDropDownList($transactions[0], '[0]EnvelopeId', ArrayHelper::map(EnvelopeSearch::findForTransferDDL(), 'Id', 'Name'))
            ?>
        </p>
        <p>
            <label for="EnvelopeId">To: </label>
            <?=
            Html::activeDropDownList($transactions[1], '[1]EnvelopeId', ArrayHelper::map(EnvelopeSearch::findForTransferDDL(), 'Id', 'Name'))
            ?>
        </p>
        <?= $form->field($transactions[0], '[0]Name')->textInput(['maxlength' => 255, 'class' => 'formControl'])->label('Optional Name') ?>

        <?= $form->field($transactions[0], '[0]PostedDate')->textInput(['class' => 'datePicker']) ?>

        <div class="form-group">
            <?= Html::submitButton('Transfer', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
<?php $this->endBlock(); ?>
