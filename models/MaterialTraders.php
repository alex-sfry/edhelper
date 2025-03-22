<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_traders".
 *
 * @property int $id
 * @property string $material_type
 * @property int $system_id
 * @property int $station_id
 *
 * @property Stations $station
 * @property Systems $system
 */
class MaterialTraders extends \yii\db\ActiveRecord
{
    /** @var float */
    public $distanceFromRef;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material_traders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['system_id', 'station_id'], 'required'],
            [['system_id', 'station_id'], 'integer'],
            [['material_type'], 'string', 'max' => 50],
            [
                ['station_id'],
                'exist', 'skipOnError' => true,
                'targetClass' => Stations::class,
                'targetAttribute' => ['station_id' => 'id']
            ],
            [
                ['system_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Systems::class,
                'targetAttribute' => ['system_id' => 'id']
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
            'material_type' => 'Material Type',
            'system_id' => 'System ID',
            'station_id' => 'Station ID',
            'distanceFromRef' => 'Distance from ref(LY)',
        ];
    }

    /**
     * Gets query for [[Station]].
     *
     * @return \yii\db\ActiveQuery|StationsQuery
     */
    public function getStation()
    {
        return $this->hasOne(Stations::class, ['id' => 'station_id']);
    }

    /**
     * Gets query for [[System]].
     *
     * @return \yii\db\ActiveQuery|SystemsQuery
     */
    public function getSystem()
    {
        return $this->hasOne(Systems::class, ['id' => 'system_id']);
    }

    /**
     * {@inheritdoc}
     * @return MaterialTradersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialTradersQuery(get_called_class());
    }
}
