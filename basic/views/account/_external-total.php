<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-total-form">

    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => 'index.php']); ?>
    <p>
        <input type="hidden" name="r" id="r" value="account/calculate" />
        <input type="hidden" name="Id" id="Id" value="<?= $account->Id ?>" />
        <label for="ExternalTotal">From Website</label>
        <input type="text" maxlength="19" name="ExternalTotal" id="ExternalTotal" value="<?= $account->ExternalTotal ?>" />
    </p>
    <p>
    <div style="text-align: left; float: left;">
        <?= Html::submitButton('Calculate', ['class' => '']) ?>         
        <?php
        $sum = number_format($account->ExternalTotal - $account->vwAccountSum->AccountSum, 2, ".", ",");
        ?>
    </div>
    <div style="text-align: right; float: right;">
        <?= $sum != 0 ? Html::a('<img alt="Create Transaction" title="Create Transaction" class="imgIcons" style="text-align: right;" src="Images/add.png" />', ['transaction/create-for-sum', 'accountId' => $account->Id, 'amount' => $sum], ['class' => 'showDialog', 'title' => 'Create Transaction']) : '' ?>

        <?= $sum ?>
    </div>
    <div style="clear: both;"></div>
</p>
<?php ActiveForm::end(); ?>

</div>
