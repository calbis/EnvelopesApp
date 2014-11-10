<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div id="page-wrap">
            <div id="navHeader">
                <?php
                NavBar::begin([
                    'brandLabel' => 'My Company',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => '',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navMenu'],
                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'Accounts', 'url' => ['/site/about']],
                        ['label' => 'Filters', 'url' => ['/site/about']],
                        ['label' => 'About', 'url' => ['/site/about']],
                        ['label' => 'Contact', 'url' => ['/site/contact']],
                        Yii::$app->user->isGuest ?
                                ['label' => 'Login', 'url' => ['/site/login']] :
                                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    ],
                ]);
                NavBar::end();
                ?>
            </div>
            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>

            <footer class="footer">
                <div class="container">
                    <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
                    <p class="pull-right"><?= Yii::powered() ?></p>
                </div>
            </footer>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
