<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * jQueryUI Autocoplete asset bundle.
 */
class AutocompleteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        YII_ENV_DEV ? 'src/css/jquery-ui.min.css' : 'dist/css/jquery-ui.min.css'
    ];
    public $js = [
        YII_ENV_DEV ? 'src/js/jquery-ui.min.js' : 'dist/js/jquery-ui.min.js',
    ];
    public $jsOptions = [
        'defer' => true,
        'position' => View::POS_BEGIN
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
