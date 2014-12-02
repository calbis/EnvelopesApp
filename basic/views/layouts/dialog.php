<?php

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>

<div style="width: 100%;">
    <?= $content ?>
    <?php if (isset($this->blocks['main-content'])): ?>
        <div id="main-content">
            <?= $this->blocks['main-content'] ?>
        </div>
    <?php endif; ?>
</div>  