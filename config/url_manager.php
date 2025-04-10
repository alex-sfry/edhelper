<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,
    'suffix' => '/',
    'rules' => [
        'search' => 'search/index',
        'material-traders' => 'material-traders/index',
        'stations' => 'stations/index',
        'engineers' => 'engineers/index',
        'economies/<slug:[\w-]+>' => 'economies/details',
        'economies' => 'economies/index',
        'trading/<slug:[\w-]+>' => 'trading/details',
        'trading' => 'trading/index',
        // 'site/contact' => 'site/contact',
        // 'site/signup' => 'site/signup',
        // 'site/login' => 'site/login',
        // 'site/logout' => 'site/logout',
        // '<action:(captcha)>'  => 'site/<action>',
        // '<controller>/<action>' =>  '<controller>/<action>',
        '' => 'site/index'
    ],
];
