<?php

namespace app\modules\admin;

use yii\base\BootstrapInterface;

/**
 * User module Bootstrap class
 */
class ModuleBootstrap implements BootstrapInterface
{
    /**
     * Bootstrap function
     *
     * @param \yii\base\Application $app
     * @return void
     */
    public function bootstrap($app)
    {
        /** @var \yii\web\Application $app */
        $app->getUrlManager()->addRules([
            'admin/supply-demand' => 'admin/supply-demand/index',
            'admin/supply-demand/view' => 'admin/supply-demand/view',
            'admin/supply-demand/update' => 'admin/supply-demand/update',
            'admin/supply-demand/create' => 'admin/supply-demand/create',
            'admin/supply-demand' => 'admin/supply-demand/index',
        ], false);
    }
}
