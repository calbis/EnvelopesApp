<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/phone.css',
        'css/tablet.css',
        'css/medium.css',
        'css/wide.css',
        'css/colors.css',
        'jquery-ui/css/smoothness/jquery-ui-1.10.0.custom.css',
    ];
    public $js = [
        'jquery-ui/js/jquery-ui-1.10.0.custom.min.js',
        'Scripts/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
