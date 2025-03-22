<?php

use yii\web\View;

return [
    // 'converter' => [
    //     'class' => 'yii\web\AssetConverter',
    //     'commands' => [],
    // ],
    'appendTimestamp' => true,
    // 'linkAssets' => true,
    // 'forceCopy' => YII_DEBUG,
    'bundles' => [
        'yii\web\JqueryAsset' => [
            'sourcePath' => '@npm/jquery/dist',
            'js' => ['jquery.min.js'],
            // 'js' => ['https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js'],
            'jsOptions' => [
                // 'defer' => '',
                'position' => View::POS_BEGIN
            ]
        ],
        'yii\bootstrap5\BootstrapAsset' => [
            'basePath' => '@webroot',
            'baseUrl' => '@web',
            'css' => [YII_ENV_DEV ? 'src/css/bootstrap.css' : 'dist/css/bootstrap.css',],
        ],
        'yii\bootstrap5\BootstrapPluginAsset' => [
            'sourcePath' => '@npm/bootstrap',
            'js' => ['dist/js/bootstrap.bundle.min.js'],
            // 'js' => [
            //     'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'
            // ],
            'jsOptions' => [
                'defer' => '',
                'position' => View::POS_HEAD
            ]
        ],
        'yii\web\YiiAsset' => [
            'sourcePath' => YII_ENV_DEV ? '@yii/assets' : 'dist/js',
            'js' => [YII_ENV_DEV ? 'yii.js' : 'yii.js'],
            'jsOptions' => [
                'defer' => '',
                'position' => View::POS_BEGIN
            ]
        ],
        'yii\grid\GridViewAsset' => [
            'sourcePath' => YII_ENV_DEV ? '@yii/assets' : 'dist/js',
            'js' => [YII_ENV_DEV ? 'yii.gridView.js' : 'yii.gridView.js'],
            'jsOptions' => [
                'defer' => '',
                'position' => View::POS_BEGIN
            ]
        ],
        'yii\captcha\CaptchaAsset' => [
            'sourcePath' => YII_ENV_DEV ? '@yii/assets' : 'dist/js',
            'js' => [YII_ENV_DEV ? 'yii.captcha.js' : 'yii.captcha.js'],
            'jsOptions' => [
                'defer' => '',
                'position' => View::POS_BEGIN
            ]
        ],
        'yii\widgets\ActiveFormAsset' => [
            'sourcePath' => YII_ENV_DEV ? '@yii/assets' : 'dist/js',
            'js' => [YII_ENV_DEV ? 'yii.activeForm.js' : 'yii.activeForm.js'],
            'jsOptions' => [
                'defer' => '',
                'position' => View::POS_BEGIN
            ]
        ],
        'yii\validators\ValidationAsset' => [
            'sourcePath' => YII_ENV_DEV ? '@yii/assets' : 'dist/js',
            'js' => [YII_ENV_DEV ? 'yii.validation.js' : 'yii.validation.js'],
            'jsOptions' => [
                'defer' => '',
                'position' => View::POS_BEGIN
            ]
        ],
    ],
];
