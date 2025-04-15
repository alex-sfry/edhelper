<?php

namespace app\controllers;

use app\models\SupplyDemand;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class EconomiesController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new SupplyDemand();
        $models = $model->find()->select(['economy_id'])->distinct()->with('economy')->all();
        asort($models);

        return $this->render('index', ['models' => $models]);
    }

    /**
     * @param string $slug
     * @return string
     */
    public function actionDetails($slug)
    {
        $model = new SupplyDemand();
        $e_models = $model->find()->distinct()->select(['economy_id'])->with('economy')->asArray()->all();
        asort($e_models);

        $d_q = $model->find()->innerJoinWith('economy')->where(['slug' => $slug]);
        $models = $d_q->asArray()->all();

        if (empty($models)) {
            return $this->redirect(['economies/index']);
        }

        $d_models = ArrayHelper::map($models, 'id', 'commodity', 'import_export');

        return $this->render('details', [
            'e_models' => $e_models,
            'd_models' => $d_models,
            'economy' => $models[0]['economy']['economy_name'],
            'slug' => $models[0]['economy']['slug']
        ]);
    }
}
