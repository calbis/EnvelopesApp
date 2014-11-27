<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?php $this->beginBlock('main-content'); ?>

<h1>Accounts</h1>
<ul>
<?php foreach ($accounts as $account): ?>
    <li>
        <?= Html::encode("{$account->name} ({$account->code})") ?>:
        <?= $account->population ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

<?php $this->endBlock(); ?>
