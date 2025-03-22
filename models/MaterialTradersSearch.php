<?php

namespace app\models;

use app\behaviors\SystemBehavior;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaterialTraders;

/**
 * StationsSearch represents the model behind the search form of `app\models\MaterialTraders`.
 */
class MaterialTradersSearch extends MaterialTraders
{
    /** @var string */
    public $refSystem;
    /** @var string */
    public $materialType;

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
            [['refSystem', 'materialType'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'refSystem' => 'Ref. System',
                'materialType' => 'Material type'
            ]
        );
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
     * @param array $params
     *
     * @return ActiveDataProvider|null
     */
    public function search()
    {
        /** @var StationsSearch|SystemBehavior $this */
        /** @var MaterialTradersQuery $query */

        $query = MaterialTraders::find()
            ->select(['material_traders.*'])
            ->innerJoinWith('station.system.security');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 50,
            ],
            'sort' => [
                'attributes' => [
                    'distanceFromRef'
                ],
                'defaultOrder' => [
                    'distanceFromRef' => SORT_ASC
                ]
            ]
        ]);

        $query->distance($this->getDistanceToSystemExpression($this->refSystem));
        $query->andFilterWhere(['material_type' => $this->materialType]);
        return $dataProvider;
    }
}
