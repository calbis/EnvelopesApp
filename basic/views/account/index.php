<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?php $this->beginBlock('main-content'); ?>

<h1>Accounts</h1>
<ul>
<?php foreach ($accounts as $account): ?>
    <li>
        <?= Html::encode("{$account->Name} ({$account->Id})") ?>:
        <?= $account->ExternalTotal ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

<?php $this->endBlock(); ?>
