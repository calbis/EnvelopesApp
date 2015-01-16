<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\i18n\Formatter;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
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

<h2><?= Html::encode($this->title) ?></h2>
<div class="editControlSwitch" style="float: right;">
    <img alt="Add/Edit/Delete Accounts" title="Add/Edit/Delete Accounts" class="imgIcons" style="text-align: right;" src="Images/pencil.png" />
</div>
<div style="float: right; margin-left: 40px; margin-right: 40px;">
    <a class="showDialog" title="Expenses Graph" href="@Url.Action(\"_Chart\", \"Accounts\")">
       <img alt="Expense Graph" title="Expense Graphs" class="imgIcons" style="text-align: right;" src="Images/pie.png" /></a>
</div>
<div class="clear"></div>
<p class="editControls hiddenEditControls">
    <?= Html::a('Create Account', ['create'], ['class' => 'btn btn-success showDialog', 'title' => 'Create Account']) ?>
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
    
    <?php $sum = 0.0; $pending = 0.0; ?>
    <?php foreach ($accounts as $account): ?>
        <tr>
            <td class="editControls hiddenEditControls">                
    <?= Html::a('Edit', ['update', 'id' => $account->Id], ['class' => 'showDialog', 'title' => 'Edit Account']) ?>
    <?= Html::a('Details', ['view', 'id' => $account->Id], ['class' => 'showDialog', 'title' => 'View Account']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $account->Id], [
            'class' => 'linkConfirm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>                
            </td>
            <td class="<?= $account->Color ?>">
                <?= Html::a($account->Name, ['envelope/index', 'accountId' => $account->Id], ['class' => $account->Color, 'title' => $account->Name]) ?>
            </td>
            <td class="editControls">
                <?= number_format(($account->vwAccountSum !== null ? $account->vwAccountSum->AccountSum : '0.00'), 2, ".", ",") ?>
            </td>
            <td class="editControls">
                <?= number_format(($account->vwAccountSum !== null ? $account->vwAccountSum->AccountPending : '0.00'), 2, ".", ",") ?>
            </td>
        </tr>
        <?php 
        if($account->vwAccountSum !== null) {
            $sum += $account->vwAccountSum->AccountSum;
            $pending += $account->vwAccountSum->AccountPending;
        }
        ?>
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
                <td><?= number_format($sum, 2, ".", ",") ?></td>
            </tr>
            <tr>
                <td>Total Pending</td>
                <td><?= number_format($pending, 2, ".", ",") ?></td>
            </tr>
            <tr>
                <td>Grand Total</td>
                <td><?= number_format($sum + $pending, 2, ".", ",") ?></td>
            </tr>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>
<?php $this->endBlock(); ?>