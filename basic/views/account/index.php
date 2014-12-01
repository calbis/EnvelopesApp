<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?php $this->beginBlock('main-content'); ?>
<!--
@if (ViewBag.ErrorMessage != null)
{
<div class="divErrorMessage">
    <h2>@ViewBag.ErrorMessage</h2>
</div>
}
-->
<div>
    <h2>Accounts</h2>
</div>
<div class="editControlSwitch" style="float: right;">
    <img alt="Add/Edit/Delete Accounts" title="Add/Edit/Delete Accounts" class="imgIcons" style="text-align: right;" src="~/Images/pencil.png" />
</div>
<div style="float: right; margin-left: 40px; margin-right: 40px;">
    <a class="showDialog" title="Expenses Graph" href="@Url.Action("_Chart", "Accounts")">
       <img alt="Expense Graph" title="Expense Graphs" class="imgIcons" style="text-align: right;" src="~/Images/pie.png" /></a>
</div>
<div class="clear"></div>
<p class="editControls hiddenEditControls">
    @Html.ActionLink("Create New", "Create", "Accounts", new { @class = "showDialog", title = "Create an Account" })
</p>
<table style="font-size: larger;">
    <tr>
        <th class="editControls hiddenEditControls"></th>
        <th>Account Name
        </th>
        <th class="editControls">Amount
        </th>
        <th class="editControls">Pending
        </th>
    </tr>

    <?php foreach ($accounts as $account): ?>
        <tr>
            <td class="editControls hiddenEditControls">
                Controls
                <!--
                @Html.ActionLink("Edit", "Edit", new { id = item.AccountId }, new { @class = "showDialog", title = "Edit Account" }) |
                @Html.ActionLink("Details", "Details", new { id = item.AccountId }, new { @class = "showDialog", title = "Account Details" }) |
                <a href="@Url.Action("Index", "UserAccounts", new { accountId = item.AccountId })">Share</a> |
                @Html.ActionLink("Delete", "Delete", new { id = item.AccountId }, new { @class = "showDialog", title = "Delete Account" })
                -->                 
            </td>
            <td class="<?= $account->Color ?>">
                <a class="<?= $account->Color ?>" href="./index.php?r=envelope/index"><?= $account->Name ?></a>
            </td>
            <td class="editControls">
                <?= $account->vwAccountSum->AccountSum ?>
            </td>
            <td class="editControls">
                <?= $account->vwAccountSum->AccountPending ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


<?php $this->endBlock(); ?>

<?php $this->beginBlock('secondary-one'); ?>

<div style="border: 1px solid black; padding: 5px;">
    <table>
        <thead>
        </thead>
        <tbody>
            <tr>
                <td>Total Amount</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Total Pending</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Grand Total</td>
                <td>0.00</td>
            </tr>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

<?php $this->endBlock(); ?>