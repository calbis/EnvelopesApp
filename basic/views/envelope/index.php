<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\i18n\Formatter;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnvelopeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Envelopes';
$this->params['breadcrumbs'][] = $this->title;
?>



<?php $this->beginBlock('main-content'); ?>

<h2><?= Html::encode($this->title) ?></h2>
<div class="editControlSwitch" style="float: right;">
    <img alt="Add/Edit/Delete Accounts" title="Add/Edit/Delete Envelopes" class="imgIcons" style="text-align: right;" src="Images/pencil.png" />
</div>
<div style="float: right; margin-left: 40px; margin-right: 40px;">
    <a class="showDialog" title="Expenses Graph" href="@Url.Action(\"_Chart\", \"Accounts\")">
       <img alt="Expense Graph" title="Expense Graphs" class="imgIcons" style="text-align: right;" src="Images/pie.png" /></a>
</div>
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
    </tr>
    
    <?php foreach ($envelopes as $envelope): ?>
        <tr>
            <td class="editControls hiddenEditControls">                
    <?= Html::a('Edit', ['update', 'id' => $envelope->Id], ['class' => 'showDialog', 'title' => 'Edit Envelope']) ?>
    <?= Html::a('Details', ['view', 'id' => $envelope->Id], ['class' => 'showDialog', 'title' => 'View Envelope']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $envelope->Id], [
            'class' => 'linkConfirm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>                
            </td>
            <td class="<?= $envelope->Color ?>">
                <?= Html::a($envelope->Name, ['transaction/index', 'envelopeId' => $envelope->Id], ['class' => $envelope->Color, 'title' => $envelope->Name]) ?>
            </td>
            <td class="editControls">
                0.00<?php // ($account->vwAccountSum !== null ? $account->vwAccountSum->AccountSum : '0.00') ?>
            </td>
            <td class="editControls">
                0.11<?php // ($account->vwAccountSum !== null ? $account->vwAccountSum->AccountPending : '0.00') ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('secondary-one'); ?>
    list of transactions
<?php $this->endBlock(); ?>