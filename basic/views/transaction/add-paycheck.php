<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\EnvelopeSearch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'Add a Paycheck';
$this->params['breadcrumbs'] = [
    ['label' => 'Accounts', 'url' => ['account/index']],
    ['label' => $account->Name, 'url' => ['envelope/index', 'accountId' => $account->Id]],
    ['label' => $this->title],
];
?>
<?php $this->beginBlock('main-content-full'); ?>
<div class="transaction-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="transaction-form">

        <?php $form = ActiveForm::begin(['options' => ['class' => '']]); ?>

        <?= $form->field($transactions[0], '[0]Name')->textInput(['maxlength' => 255, 'class' => 'formControl'])->label('Name') ?>

        <?= $form->field($transactions[0], '[0]PostedDate')->textInput(['class' => 'datePicker']) ?>
        <label for="txtDepositAmount">Deposit Amount</label>
        <input id="txtDepositAmount" type="text" />
        <div class="divAddPaycheckRight">
            Amount Left to Deposit: <span class="divAddPaycheckRemaining">0</span>
        </div>

        <table style="font-size: larger;">
            <thead>
                <tr>
                    <th>Envelope</th>
                    <th class="editControls">Amount</th>
                    <th class="editControls">Pending</th>
                    <th class="editControls">Cost/Month</th>
                    <th class="editControls">Months Left</th>
                    <th class="editControls">To Deposit</th>
                    <th class="editControls">Amount</th>
                    <th class="editControls">Pending</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $key => $t): ?>
                    <tr>
                        <td style="color: <?= $envelopes[$key]->Color ?>">
                            <span style="color: <?= $envelopes[$key]->Color ?>"><?= $envelopes[$key]->Name ?></span>
                        </td>
                        <td>
                            <?= $envelopes[$key]->vwEnvelopeSum->EnvelopeSum ?>
                        </td>
                        <td>
                            <?= $envelopes[$key]->vwEnvelopeSum->EnvelopePending ?>
                        </td>
                        <td>
                            <?= $envelopes[$key]->vwEnvelopeSum->StatsCost ?>
                        </td>
                        <td>
                            <?= $envelopes[$key]->vwEnvelopeSum->TimeLeft ?>
                        </td>
                        <td>
                            <?= $envelopes[$key]->vwEnvelopeSum->GoalDeposit ?>
                        </td>
                        <td>
                            <?= $form->field($t, "[$key]Amount", ['options' => ['class' => ''], 'errorOptions' => ['class' => 'displayNone']])->textInput(['maxlength' => 19, 'style' => 'width: 80px;', 'class' => 'txtAddPaycheckAmount'])->label('', ['class' => 'displayNone']) ?>
                        </td>
                        <td>
                            <?= $form->field($t, "[$key]Pending", ['options' => ['class' => ''], 'errorOptions' => ['class' => 'displayNone']])->textInput(['maxlength' => 19, 'style' => 'width: 80px;', 'class' => 'txtAddPaycheckPending'])->label('', ['class' => 'displayNone']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Envelope</th>
                    <th class="editControls">Amount</th>
                    <th class="editControls">Pending</th>
                    <th class="editControls">Cost/Month</th>
                    <th class="editControls">Months Left</th>
                    <th class="editControls">To Deposit</th>
                    <th class="editControls">Amount</th>
                    <th class="editControls">Pending</th>
                </tr>
            </tfoot>
        </table>
        <div class="divAddPaycheckRight">
            Amount Left to Deposit: <span class="divAddPaycheckRemaining">0</span>
            <br />
            <?= Html::submitButton('Add Paycheck', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
<?php $this->endBlock(); ?>
<div id="main-content-fullHidden">
    Feature requires a large screen to render
</div>
