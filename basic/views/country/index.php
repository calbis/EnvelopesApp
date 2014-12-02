<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?php $this->beginBlock('main-content'); ?>

<h1>Countries</h1>
<ul>
<?php foreach ($countries as $country): ?>
    <li>
        <?= Html::encode("{$country->name} ({$country->code})") ?>:
        <?= $country->population ?>
    </li>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

<?php $this->endBlock(); ?>
