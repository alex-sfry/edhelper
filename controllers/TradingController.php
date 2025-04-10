<?php

namespace app\controllers;

use app\models\Economies;
use app\models\SupplyDemand;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class TradingController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new SupplyDemand();
        $query = $model->find()->select(['economy_id'])->distinct()->with('economy');

        return $this->render('index', ['models' => $query->all()]);
    }

    /**
     * @param string $slug
     * @return string
     */
    public function actionDetails($slug)
    {
        $model = new SupplyDemand();
        $models = $model->find()->innerJoinWith('economy')->where(['slug' => $slug])->asArray()->one();

        if (empty($models)) {
            return $this->redirect(['economies/index']);
        }

        $economies_model = $model->find()->distinct()->select(['economy_id'])->with('economy')->asArray()->all();
        $economy_id = Economies::findOne(['slug' => $slug]);

        $export_q = $model->find()
            ->select(['commodity'])
            ->innerJoinWith('economy')
            ->where(['economy_id' => $economy_id->id, 'import_export' => 'export']);

        $target_q = $model->find()
            ->select(['economy_id', 'commodity'])
            ->with('economy')
            ->where(['commodity' => $export_q, 'import_export' => 'import']);

        $target_e_models = ArrayHelper::map(
            $target_q->asArray()->all(),
            'economy.economy_name',
            'economy.economy_name',
            'commodity'
        );

        return $this->render('details', [
            'economies_model' => $economies_model,
            'economy' => $models['economy']['economy_name'],
            'slug' => $slug,
            'target_e_models' => $target_e_models
        ]);
    }
}
