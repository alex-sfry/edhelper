<?php

namespace app\models\forms;

use app\models\SupplyDemand;

class SupplyDemandForm extends SupplyDemand
{
    /**
     * @var array
     */
    public $eco_ids;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['import_export', 'commodity', 'import_export'], 'required'],
            [['commodity'], 'string', 'max' => 50],
            [['import_export'], 'string', 'max' => 10],
            [
                ['eco_ids'],
                'in',
                'range' => [1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18], 'allowArray' => true
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), ['eco_ids' => 'Economies']);
    }
}
