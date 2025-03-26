<?php

namespace app\models;

use app\behaviors\SystemBehavior;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Stations;

/**
 * StationsSearch represents the model behind the search form of `app\models\Stations`.
 */
class StationsSearch extends Stations
{
    /** @var string */
    public $refSystem;
    /** @var int */
    public $distance_to_arrival;
    /** @var string */
    public $inclSurface = 'No';
    /** @var string */
    public $minPadSize = 'L';
    /** @var string */
    public $economyId1;

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [SystemBehavior::class]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['refSystem', 'default', 'value' => 'Sol'],
            ['inclSurface', 'default', 'value' => 'No'],
            [['distance_to_arrival'], 'integer'],
            [['minPadSize', 'inclSurface', 'economyId1', 'refSystem'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'refSystem' => 'Ref. System',
            'distance_to_arrival' => 'Distance To Arrival (ls)',
            'minPadSize' => 'Min. Pad Size',
            'inclSurface' => 'Include Surface',
            'economyId1' => 'Economy'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @return ActiveDataProvider|null
     */
    public function search()
    {
        /** @var StationsSearch|SystemBehavior $this */
        /** @var StationsQuery $query */

        $query = Stations::find()
            ->select(['stations.*'])
            ->with('economyId1')
            ->with('system.security')
            ->innerJoinWith('system');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 50,
            ],
            'sort' => [
                'attributes' => [
                    'distanceFromRef',
                    'distance_to_arrival'
                ],
                'defaultOrder' => [
                    'distanceFromRef' => SORT_ASC
                ]
            ]
        ]);

        $this->refSystem && $query->distance($this->getDistanceToSystemExpression($this->refSystem));
        $query->andFilterWhere(['economy_id_1' => $this->economyId1]);
        $query->andFilterWhere(['<=', 'distance_to_arrival', $this->distance_to_arrival]);

        if ($this->minPadSize === 'L') {
            $query->andWhere(['not', ['type' => 'Outpost']]);
        }
        if ($this->inclSurface === 'No') {
            $query->andWhere(['not', ['type' => ['Planetary Outpost', 'Planetary Port', 'Odyssey Settlement']]]);
        }
        if ($this->inclSurface === 'Yes') {
            $query->andWhere(['not', ['type' => 'Odyssey Settlement']]);
        }

        // $query->distanceFilter($expr, $this->distanceFromRef);

        return $dataProvider;
    }
}
