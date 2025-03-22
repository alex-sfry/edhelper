<?php

namespace app\controllers;

use app\models\Engineers;

class EngineersController extends \yii\web\Controller
{
    /**
     * Index action.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Engineers::find()
            ->with(['engineersUpgrades', 'station', 'system'])
            ->all();

        return $this->render('index', [
            'data' => $data
        ]);
    }
}
