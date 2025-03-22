<?php

namespace app\controllers;

use app\models\StationsSearch;
use Yii;
use yii\web\Controller;

class StationsController extends Controller
{
    /**
     * Lists all Stations models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->request->get() && $session->set('sti', $this->request->get());
        $searchModel = new StationsSearch();

        if (empty($session->get('sti'))) {
            return $this->render('index', ['searchModel' => $searchModel]);
        }
        if (!$searchModel->load($session->get('sti')) || !$searchModel->validate()) {
            return $this->render('index', ['searchModel' => $searchModel]);
        }

        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'sort' => $dataProvider->getSort(),
            'pagination' => $dataProvider->getPagination(),
            'models' => $dataProvider->getModels()
        ]);
    }
}
