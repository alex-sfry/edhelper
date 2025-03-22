<?php

namespace app\models;

use app\behaviors\SystemBehavior;
use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[Stations]].
 *
 * @see Stations
 */
class StationsQuery extends \yii\db\ActiveQuery
{
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
     * @return Stations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Stations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Distance from ref star
     *
     * @param Expression $expr
     * @return \yii\db\ActiveQuery
     */
    public function distance($expr)
    {
        $this->addSelect(["$expr as distanceFromRef"]);

        return $this;
    }

    /**
     * Distance from ref star filterWhere
     *
     * @param Expression $expr Expression to calculate range - see SystemBehavior
     * @return \yii\db\ActiveQuery
     */
    public function distanceFilter($expr, $range = 50)
    {
        $this->andFilterWhere(['<=', $expr, $range]);

        return $this;
    }
}
