<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SupplyDemand;

/**
 * SupplyDemandSearch represents the model behind the search form of `app\models\SupplyDemand`.
 */
class SupplyDemandSearch extends SupplyDemand
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'economy_id'], 'integer'],
            [['commodity', 'import_export'], 'safe'],
        ];
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = SupplyDemand::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'economy_id' => $this->economy_id,
        ]);

        $query->andFilterWhere(['like', 'commodity', $this->commodity])
            ->andFilterWhere(['like', 'import_export', $this->import_export]);

        return $dataProvider;
    }
}
