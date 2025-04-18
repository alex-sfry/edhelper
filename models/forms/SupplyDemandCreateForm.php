<?php

namespace app\models\forms;

use app\models\Economies;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class SupplyDemandCreateForm extends Model
{
    /** @var string */
    public $commodity;

    /** @var string */
    public $import_export;

    /** @var array */
    public $economy_ids;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['economy_ids', 'commodity', 'import_export'], 'required'],
            ['economy_ids', 'each', 'rule' => ['integer']],
            [['commodity', 'import_export'], 'string'],
            ['import_export', 'in', 'range' => ['import', 'export']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'commodity' => 'Commodity',
            'economy_ids' => 'Economies',
            'import_export' => 'Import/Export',
        ];
    }

    /**
     * @return array
     */
    public function getEconomyList()
    {
        $economies = Economies::find()
            ->select(['id', 'economy_name'])
            ->where(['not', ['id' => [16, 17, 18]]])
            ->indexBy('id')
            ->asArray()
            ->all();
        // d(ArrayHelper::getColumn($economies, 'economy_name'));

        return ArrayHelper::getColumn($economies, 'economy_name');
    }
}
