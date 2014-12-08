<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\i18n\Formatter;

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
                <td>Current Account Total hdnAccountId</td>
                <td><?= $account->vwAccountSum->AccountSum + $account->vwAccountSum->AccountPending ?></td>
            </tr>
            <tr>
                <td>From WebSite</td>
                <td>TextBox = <?= $account->ExternalTotal ?></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Calculate" /></td>
                <td>
                    Conditional Add Transaction button
                    <?php
//                    
//                            @if (ViewBag.Account.ExternalTotal - ViewBag.Account.AmountSum != 0)
//                            {
//                                @(ViewBag.Account.ExternalTotal - ViewBag.Account.AmountSum)
//                                <a class="showDialog" title="Add Transaction" href="@Url.Action("Create", "Transactions", new { accountId = ViewBag.Account.AccountId })">
//                                    <img alt="Add Transaction" title="Add Transaction" class="imgIcons" style="text-align: right;" src="~/Images/add.png" />
//                                </a>
//                            }
//                    
                    ?>
                </td>
            </tr>
        </tbody>
        <tfoot></tfoot>
    </table>
    }
</div>
<div>
    <table>
        <thead></thead>
        <tbody>
            <?php
//                @foreach (EnvelopesApplication.Models.vwUserTransaction ut in (List<EnvelopesApplication.Models.vwUserTransaction>)ViewBag.PendingGroup)
//                {
//                    <tr>
//                        <td>@ut.TransactionName</td>
//                        <td>@ut.TransactionPending</td>
//                        <td>
//                            <a href="@Url.Action("MoveNamedPending", "Transactions", new { accountId = ut.AccountId, transactionName = ut.TransactionName })">
//                                <img alt="Move Pending for Group" title="Move Pending for Grop" class="imgIcons" style="text-align: right;" src="~/Images/movePending.jpeg" /></a>
//                        </td>
//                    </tr>
//                }
            ?>
        </tbody>
        <tfoot></tfoot>
    </table>
</div>
<div class="editControlSwitch" style="float: right; margin-left: 40px;">
    <img alt="Add/Edit/Delete Accounts" title="Add/Edit/Delete Envelopes" class="imgIcons" style="text-align: right;" src="Images/pencil.png" />
</div>
<div style="float: right; margin-left: 40px;">
    <a href="@Url.Action("AddPaycheck", "Transactions", new { accountId = ViewBag.Account.AccountId })">
       <img alt="Add a Paycheck" title="Add a Paycheck" class="imgIcons" style="text-align: right;" src="Images/paycheck.jpg" /></a>
</div>
<div style="float: right; margin-left: 40px;">
    <a class="showDialog" title="Transfer Funds" href="@Url.Action("AddTransfer", "Transactions", new { accountId = ViewBag.Account.AccountId })">
       <img alt="Transfer Funds" title="Transfer Funds" class="imgIcons" style="text-align: right;" src="Images/transfer.png" /></a>
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
        <th class="editControls">Remaining
        </th>
    </tr>

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
            <td class="<?= $envelope->Color ?>">
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
<?php // $this->render('//transaction/account-transactions') ?>

<?php $this->endBlock(); ?>