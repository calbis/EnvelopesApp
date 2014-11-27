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
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href="~/css/colors.css" />
        <link rel='stylesheet' media='screen and (max-width: 600px)' href='~/css/phone.css' />
        <link rel='stylesheet' media='screen and (min-width: 601px) and (max-width: 900px)' href='~/css/tablet.css' />
        <link rel='stylesheet' media='screen and (min-width: 901px) and (max-width: 1200px)' href='~/css/medium.css' />
        <link rel='stylesheet' media='screen and (min-width: 1201px)' href='~/css/wide.css' />

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div id="page-wrap">
            <div id="header">
                <div>
                    <section id="login">
                        login
                    </section>
                    <nav>
                        <ul id="menu">
                            <li><a href="<?= Url::home(); ?>">Home</a></li>
                            <li><a href="./index.php?r=account/index">Accounts</a></li>
                            <li><a href="<?= Url::home(); ?>">Filters</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="container">
                <?= $content ?>
                <?php if (isset($this->blocks['main-content'])): ?>
                    <div id="main-content">
                        <?= $this->blocks['main-content'] ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($this->blocks['secondary-one'])): ?>
                    <div id="secondary-one">
                        <?= $this->blocks['secondary-one'] ?>
                    </div>
                <?php endif; ?>

            </div>

            <footer class="footer">
                <div class="container">
                    <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
                    <p class="pull-right"><?= Yii::powered() ?></p>
                </div>
            </footer>
        </div>
        <?php $this->endBody() ?>

        <div class="contextMenu" id="myMenu1">
            <ul>
                <li id="cmMovePending">
                    <img src="Images/movePending.jpeg" width="16" />
                    Move Pending</li>
                <li id="cmEdit">
                    <img src="Images/edit.png" />
                    Edit</li>
                <li id="cmDetails">
                    <img src="Images/information.png" />
                    Details</li>
                <li id="cmDelete">
                    <img src="Images/delete.png" />
                    Delete</li>
            </ul>
        </div>
    </body>
</html>
<?php $this->endPage() ?>
