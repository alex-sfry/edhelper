<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stations".
 *
 * @property int $id
 * @property int|null $market_id
 * @property int|null $system_id
 * @property string $name
 * @property string|null $type
 * @property int|null $distance_to_arrival
 * @property string|null $government
 * @property int|null $allegiance_id
 * @property int|null $economy_id_1
 * @property int|null $economy_id_2
 *
 * @property Allegiance $allegiance
 * @property Economies $economyId1
 * @property Economies $economyId2
 * @property Systems $system
 */
class Stations extends \yii\db\ActiveRecord
{
    /** @var string */
    private $pad;
    /** @var bool */
    private $surface;
    /** @var float */
    public $distanceFromRef;
    /** @var mixed */
    public $value;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['market_id', 'system_id', 'distance_to_arrival	', 'allegiance_id', 'economy_id_1', 'economy_id_2'],
                'integer'
            ],
            [['name'], 'required'],
            [['name', 'type', 'government'], 'string'],
            [['market_id'], 'unique'],
            [
                ['economy_id_1'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Economies::class,
                'targetAttribute' => ['economy_id_1' => 'id']
            ],
            [
                ['allegiance_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Allegiance::class,
                'targetAttribute' => ['allegiance_id' => 'id']
            ],
            [
                ['economy_id_2'],
                'exist', 'skipOnError' => true,
                'targetClass' => Economies::class,
                'targetAttribute' => ['economy_id_2' => 'id']
            ],
            [
                ['system_id'],
                'exist', 'skipOnError' => true,
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
            'market_id' => 'Market ID',
            'system_id' => 'System ID',
            'name' => 'Station',
            'type' => 'Type',
            'distance_to_arrival' => 'Distance To Arrival',
            'government' => 'Government',
            'allegiance_id' => 'Allegiance ID',
            'economy_id_1' => 'Economy',
            'economy_id_2' => 'Economy(secondary)',
            'economyId1' => 'Economy',
            'pad' => 'Pad',
            'distanceFromRef' => 'Distance',
        ];
    }

    /**
     * pad prop getter
     *
     * @return string
     */
    public function getPad()
    {
        if ($this->type !== 'Outpost') {
            $this->pad = 'L';
        } else {
            $this->pad = 'M';
        }

        return $this->pad;
    }

    /**
     * surface prop getter
     *
     * @return bool
     */
    public function getSurface()
    {
        $spaceTypes = ['Ocellus Starport', 'Outpost', 'Orbis Starport', 'Coriolis Starport', 'Asteroid base'];

        if (!in_array($this->type, $spaceTypes)) {
            $this->surface = true;
        } else {
            $this->surface = false;
        }

        return $this->surface;
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
     * Gets query for [[EconomyId1]].
     *
     * @return \yii\db\ActiveQuery|EconomiesQuery
     */
    public function getEconomyId1()
    {
        return $this->hasOne(Economies::class, ['id' => 'economy_id_1']);
    }

    /**
     * Gets query for [[EconomyId2]].
     *
     * @return \yii\db\ActiveQuery|EconomiesQuery
     */
    public function getEconomyId2()
    {
        return $this->hasOne(Economies::class, ['id' => 'economy_id_2']);
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
     * @return StationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StationsQuery(get_called_class());
    }
}
