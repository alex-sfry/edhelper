<?php

namespace app\controllers;

use app\models\MaterialTradersSearch;
use Yii;
use yii\web\Controller;

class MaterialTradersController extends Controller
{
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->request->get() && $session->set('mt', $this->request->get());
        $searchModel = new MaterialTradersSearch();
        $searchModel->load($session->get('mt'));

        if (!$searchModel->validate()) {
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
