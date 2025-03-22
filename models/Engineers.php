<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "engineers".
 *
 * @property int $id
 * @property string $name
 * @property string|null $discovery
 * @property string|null $get_invite
 * @property string|null $unlock
 * @property int $station_id
 * @property int $system_id
 *
 * @property EngineersUpgrades[] $engineersUpgrades
 * @property Stations $station
 * @property Systems $system
 */
class Engineers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'engineers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'station_id', 'system_id'], 'required'],
            [['name', 'discovery', 'get_invite', 'unlock'], 'string'],
            [['station_id', 'system_id'], 'integer'],
            [['station_id'], 'unique'],
            [['name'], 'unique'],
            [
                ['station_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Stations::class, 'targetAttribute' => ['station_id' => 'id']
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
            'name' => 'Name',
            'discovery' => 'Discovery',
            'get_invite' => 'Get Invite',
            'unlock' => 'Unlock',
            'station_id' => 'Station ID',
            'system_id' => 'System ID',
        ];
    }

    /**
     * Gets query for [[EngineersUpgrades]].
     *
     * @return \yii\db\ActiveQuery|EngineersUpgradesQuery
     */
    public function getEngineersUpgrades()
    {
        return $this->hasMany(EngineersUpgrades::class, ['engineer_id' => 'id']);
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
}
