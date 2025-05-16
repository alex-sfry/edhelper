<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "systems".
 *
 * @property int $id
 * @property string $name
 * @property float|null $x
 * @property float|null $y
 * @property float|null $z
 * @property int|null $population
 * @property int|null $security_id
 * @property int|null $allegiance_id
 * @property int|null $economy_id
 *
 * @property Allegiance $allegiance
 * @property Economies $economy
 * @property Security $security
 * @property Stations[] $stations
 */
class Systems extends \yii\db\ActiveRecord
{
    /** @var mixed */
    public $value;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'systems';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['x', 'y', 'z'], 'number'],
            [['population', 'security_id', 'allegiance_id', 'economy_id'], 'integer'],
            [['name'], 'unique'],
            [
                ['allegiance_id'],
                'exist', 'skipOnError' => true,
                'targetClass' => Allegiance::class,
                'targetAttribute' => ['allegiance_id' => 'id']
            ],
            [
                ['economy_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Economies::class,
                'targetAttribute' => ['economy_id' => 'id']
            ],
            [
                ['security_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Security::class,
                'targetAttribute' => ['security_id' => 'id']
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
            'name' => 'System',
            'x' => 'X',
            'y' => 'Y',
            'z' => 'Z',
            'population' => 'Population',
            'security_id' => 'Security ID',
            'allegiance_id' => 'Allegiance ID',
            'economy_id' => 'Economy ID',
        ];
    }

    /**
     * Gets query for [[Allegiance]].
     *
     * @return \yii\db\ActiveQuery|AllegianceQuery
     */
    public function getAllegiance()
    {
        return $this->hasOne(Allegiance::class, ['id' => 'allegiance_id']);
    }

    /**
     * Gets query for [[Economy]].
     *
     * @return \yii\db\ActiveQuery|EconomiesQuery
     */
    public function getEconomy()
    {
        return $this->hasOne(Economies::class, ['id' => 'economy_id']);
    }

    /**
     * Gets query for [[Security]].
     *
     * @return \yii\db\ActiveQuery|SecurityQuery
     */
    public function getSecurity()
    {
        return $this->hasOne(Security::class, ['id' => 'security_id']);
    }

    /**
     * Gets query for [[Stations]].
     *
     * @return \yii\db\ActiveQuery|StationsQuery
     */
    public function getStations()
    {
        return $this->hasMany(Stations::class, ['system_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SystemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SystemsQuery(get_called_class());
    }
}
