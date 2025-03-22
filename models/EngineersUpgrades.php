<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "engineers_upgrades".
 *
 * @property int $id
 * @property string $upgrade
 * @property int $engineer_id
 *
 * @property Engineers $engineer
 */
class EngineersUpgrades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'engineers_upgrades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['upgrade', 'engineer_id'], 'required'],
            [['upgrade'], 'string'],
            [['engineer_id'], 'integer'],
            [
                ['engineer_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Engineers::class, 'targetAttribute' => ['engineer_id' => 'id']
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
            'upgrade' => 'Upgrade',
            'engineer_id' => 'Engineer ID',
        ];
    }

    /**
     * Gets query for [[Engineer]].
     *
     * @return \yii\db\ActiveQuery|EngineersQuery
     */
    public function getEngineer()
    {
        return $this->hasOne(Engineers::class, ['id' => 'engineer_id']);
    }
}
