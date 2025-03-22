<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supply_demand".
 *
 * @property int $id
 * @property string|null $commodity
 * @property int $economy_id
 * @property string $import_export
 *
 * @property Economies $economy
 */
class SupplyDemand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supply_demand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['economy_id', 'import_export'], 'required'],
            [['economy_id'], 'integer'],
            [['commodity'], 'string', 'max' => 50],
            [['import_export'], 'string', 'max' => 10],
            [
                ['economy_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Economies::class, 'targetAttribute' => ['economy_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'commodity' => 'Commodity',
            'economy_id' => 'Economy ID',
            'import_export' => 'Import/Export',
        ];
    }

    /**
     * Gets query for [[Economy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEconomy()
    {
        return $this->hasOne(Economies::class, ['id' => 'economy_id']);
    }
}
