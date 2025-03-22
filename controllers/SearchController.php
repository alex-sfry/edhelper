<?php

namespace app\controllers;

use app\models\Stations;
use app\models\Systems;
use InvalidArgumentException;
use Yii;
use yii\web\Response;

class SearchController extends \yii\web\Controller
{
    /** @var array */
    private $result;

    /**
     * Index action.
     *
     * @return array
     * @throws InvalidArgumentException
     */
    public function actionIndex()
    {
        $cat = Yii::$app->request->get('cat');
        $term = Yii::$app->request->get('term');

        if (empty($cat) || empty($term)) {
            throw new InvalidArgumentException('required parasm are missing (cat, term)');
        }

        $cat === 'system' && $this->findSystem($term);
        $cat === 'station' && $this->findStation($term);
        $this->response->format = Response::FORMAT_JSON;
        return $this->result;
    }

    /**
     * Find system by name
     *
     * @param string $systemName
     * @return void
     */
    private function findSystem($systemName)
    {
        $systems = Systems::find()
            ->select('name AS value')
            ->where(
                new \yii\db\Expression('name LIKE :sys_name', [':sys_name' => $systemName . '%'])
            )
            ->asArray()
            ->all();
        $this->result = $systems;
    }

    /**
     * Find station by name
     *
     * @param string $stationName
     * @return void
     */
    private function findStation($stationName)
    {
        $stations = Stations::find()
            ->select(['id', 'name'])
            ->where(
                new \yii\db\Expression('name LIKE :st_name', [':st_name' => $stationName . '%'])
            )
            ->all();
        $this->result = $stations;
    }
}
