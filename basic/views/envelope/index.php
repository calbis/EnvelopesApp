<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnvelopeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Envelopes';
$this->params['breadcrumbs'] = [
    ['label' => 'Accounts', 'url' => ['account/index']],
    ['label' => $account->Name],
];
?>



<?php $this->beginBlock('main-content'); ?>
<div>
    <table>
        <thead></thead>
        <tbody>
            <tr>
                <td>Account Grand Total</td>
                <td><?= $account->vwAccountSum->AccountSum ?></td>
            </tr>
            <tr>
                <td>Account Pending</td>
                <td><?= $account->vwAccountSum->AccountPending ?></td>
            </tr>
            <tr style="font-weight: bold;">
                <td>Current Account Total</td>
                <td><?= $account->vwAccountSum->AccountSum + $account->vwAccountSum->AccountPending ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <?=
                    $this->render('/account/_external-total', [
                        'account' => $account,
                    ])
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?=
                    $this->render('_pending-transactions', [
                        'account' => $account,
                        'transactions' => $pendingTransactions
                    ])
                    ?>
                </td>
            </tr>
        </tbody>
        <tfoot></tfoot>
    </table>
</div>
<div>
    <table>
        <thead></thead>
        <tbody>

        </tbody>
        <tfoot></tfoot>
    </table>
</div>
<div class="editControlSwitch" style="float: right; margin-left: 40px;">
    <img alt="Add/Edit/Delete Accounts" title="Add/Edit/Delete Envelopes" class="imgIcons" style="text-align: right;" src="Images/pencil.png" />
</div>
<div style="float: right; margin-left: 40px;">
    <?=
    Html::a('<img alt="Add a Paycheck" title="Add a Paycheck" class="imgIcons" style="text-align: right;" src="Images/paycheck.jpg" /></a>', ['transaction/add-paycheck', 'accountId' => $account->Id], ['class' => '', 'title' => 'Add Paycheck'])
    ?>
</div>
<div style="float: right; margin-left: 40px;">
    <?=
    Html::a('<img alt="Transfer Funds" title="Transfer Funds" class="imgIcons" style="text-align: right;" src="Images/transfer.png" />', ['transaction/transfer'], ['class' => 'showDialog', 'title' => 'Transfer Funds'])
    ?>
</div>
<div style="float: right; margin-left: 40px;">
    <a class="showDialog" title="Expenses Graph" href="@Url.Action("_Chart", "Envelopes", new { accountId = ViewBag.Account.AccountId })">
       <img alt="Expense Graph" title="Expense Graphs" class="imgIcons" style="text-align: right;" src="Images/pie.png" /></a>
</div>
<h2 class="<?= $account->Color ?>"><?= $account->Name ?></h2>


<div class="clear"></div>
<p class="editControls hiddenEditControls">
    <?= Html::a('Create Envelope', ['create', 'accountId' => $account->Id], ['class' => 'btn btn-success showDialog', 'title' => 'Create Envelope']) ?>
</p>
<table style="font-size: larger;">
    <thead>
        <tr>
            <th class="editControls hiddenEditControls"></th>
            <th>Envelope
            </th>
            <th class="editControls">Amount
            </th>
            <th class="editControls">Pending
            </th>
            <th class="editControls">Cost/Month
            </th>
            <th class="editControls">Remain
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($envelopes as $envelope): ?>
            <tr>
                <td class="editControls hiddenEditControls">                
                    <?= Html::a('Edit', ['update', 'id' => $envelope->Id], ['class' => 'showDialog', 'title' => 'Edit Envelope']) ?>
                    <?= Html::a('Details', ['view', 'id' => $envelope->Id], ['class' => 'showDialog', 'title' => 'View Envelope']) ?>
                    <?=
                    Html::a('Delete', ['delete', 'id' => $envelope->Id], [
                        'class' => 'linkConfirm',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>                
                </td>
                <td class="<?= $envelope->Color ?> tdNonWrap">
                    <?= Html::a('<img alt="Create Transaction" title="Create Transaction" class="imgIcons" style="text-align: right;" src="Images/add.png" />', ['transaction/create', 'envelopeId' => $envelope->Id], ['class' => 'showDialog', 'title' => 'Create Transaction']) ?>    
                    <?= Html::a($envelope->Name, ['transaction/index', 'envelopeId' => $envelope->Id], ['class' => $envelope->Color, 'title' => $envelope->Name]) ?>
                </td>
                <td class="editControls">
                    <?= ($envelope->vwEnvelopeSum !== null ? $envelope->vwEnvelopeSum->EnvelopeSum : '0.00') ?>
                </td>
                <td class="editControls">
                    <?= ($envelope->vwEnvelopeSum !== null ? $envelope->vwEnvelopeSum->EnvelopePending : '0.00') ?>
                </td>
                <td class="editControls">
                    <?= ($envelope->vwEnvelopeSum !== null ? $envelope->vwEnvelopeSum->StatsCost : '0.00') ?>
                </td>
                <td class="editControls">
                    <?= ($envelope->vwEnvelopeSum !== null ? $envelope->vwEnvelopeSum->TimeLeft : '0.00') ?>
                </td>
            </tr>
        <?php endforeach; ?>
</table>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('secondary-one'); ?>
<?=
$this->render('account-transactions', [
    'dataProvider' => $atDataProvider,
    'searchModel' => $atSearchModel,
])
?>
<?php //$this->renderAjax('//transaction/account-transactions', ['accountId' => $account->Id]) ?>
<?php $this->endBlock(); ?>