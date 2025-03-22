<?php

namespace app\commands;

use app\models\Engineers;
use app\models\EngineersUpgrades;
use app\models\Stations;
use app\models\Systems;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;

class EngController extends Controller
{
    /**
     * @return ExitCode
     */
    public function actionIndex()
    {
        echo 'Index Action of EngController';
        return ExitCode::OK;
    }

    /**
     * Fills engineers_upgrades table
     *
     * @return ExitCode
     */
    public function actionUpgrades()
    {
        $jsonFilePath = Yii::getAlias('@app/data/engineers.json');
        $jsonData = file_get_contents($jsonFilePath);
        $dataArray = Json::decode($jsonData, true);
        $upgrades = [];

        foreach ($dataArray as $key => $value) {
            foreach ($value['upgrades'] as $val) {
                $upgrades[] = ['upgrade' => $val, 'engineer_id' => $dataArray[$key]['id']];
            }
        }

        /** @var EngineersUpgrades[] */
        $models = [];
        $errors = [];

        for ($i = 0; $i < count($upgrades); $i++) {
            $models[$i] = new EngineersUpgrades();
        }

        foreach ($upgrades as $key => $value) {
            if ($models[$key]->load($value, '') && $models[$key]->validate()) {
                $models[$key]->save();
            } else {
                $errors[] = $models[$key]->getErrors();
            }
        }

        $errors && VarDumper::dump($errors);
        return ExitCode::OK;
    }

    /**
     * Fills engineers table
     *
     * @return ExitCode
     */
    public function actionEngineers()
    {
        $jsonFilePath = Yii::getAlias('@app/data/engineers.json');
        $jsonData = file_get_contents($jsonFilePath);
        $dataArray = Json::decode($jsonData, true);
        /** @var string[] */
        $stations = [];
        /** @var string[] */
        $systems = [];

        foreach ($dataArray as $key => $value) {
            $stations[] = $value['station'];
            $systems[] = $value['system'];
            unset($dataArray[$key]['target'], $dataArray[$key]['upgrades']);
        }

        $stations_query = Stations::find()
            ->indexBy('station')
            ->select(['stations.id as station_id', 'stations.name as station', 'systems.id as system_id'])
            ->joinWith('system')
            ->where(['systems.name' => $systems, 'stations.name' => $stations]);

        $sys_st = $stations_query->asArray()->all();

        foreach ($dataArray as $key => $value) {
            $dataArray[$key]['station_id'] = $sys_st[$value['station']]['station_id'];
            $dataArray[$key]['system_id'] = $sys_st[$value['station']]['system_id'];
            unset($dataArray[$key]['station'], $dataArray[$key]['system']);
        }

        // VarDumper::dump($dataArray);

        /** @var Engineers[] */
        $models = [];
        $errors = [];

        for ($i = 0; $i < count($dataArray); $i++) {
            $models[$i] = new Engineers();
        }

        foreach ($dataArray as $key => $value) {
            if ($models[$key]->load($value, '') && $models[$key]->validate()) {
                $models[$key]->save();
            } else {
                $errors[] = $models[$key]->getErrors();
            }
        }

        $errors && VarDumper::dump($errors);
        return ExitCode::OK;
    }
}
