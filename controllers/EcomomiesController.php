<?php

namespace app\controllers;

use app\models\Economies;
use app\models\SupplyDemand;
use yii\web\Controller;

class EcomomiesController extends Controller
{
    /**
     * @param string $economy_id
     * @return string
     */
    public function actionIndex($slug = 'high-tech')
    {
        if (empty($slug)) {
            $slug = 'high-tech';
        }

        $economies = Economies::find()
            ->select('economy_name')
            ->where(['not', ['economy_name' => ['None', 'unknown', 'Private Enterprise']]])
            ->all();

        $models = SupplyDemand::find()
            ->joinWith('economy')
            ->where(['slug' => $slug])
            ->all();

        return $this->render('index', ['models' => $models, 'economies' => $economies]);
    }
}
