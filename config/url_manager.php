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
        'user/signup' => 'user/signup',
        'user/login' => 'user/login',
        'user/logout' => 'user/logout',
        'user/request-password-reset' => 'user/request-password-reset',
        'user/reset-password' => 'user/reset-password',
        'user/verify-email' => 'user/verify-email',
        'user/resend-verification-email' => 'user/resend-verification-email',
        // 'site/contact' => 'site/contact',
        // '<action:(captcha)>'  => 'site/<action>',
        // '<controller>/<action>' =>  '<controller>/<action>',
        '' => 'site/index'
    ],
];
