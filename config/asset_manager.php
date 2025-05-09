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
    ],
];
