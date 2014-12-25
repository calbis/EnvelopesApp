<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="divPendingTransactions">
    <?php foreach ($transactions as $t): ?>
        <div>
            <?= $t['value'] ?>
            <?= $t['pending'] ?>
            <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', ['bulk-move-pending', 'accountId' => $account->Id, 'type' => $t['type'], 'value' => $t['value']], ['class' => '', 'title' => 'Bulk Move Pending']) ?>
        </div>            
    <?php endforeach; ?>
</div>
