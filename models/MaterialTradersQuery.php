<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MaterialTraders]].
 *
 * @see MaterialTraders
 */
class MaterialTradersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MaterialTraders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MaterialTraders|array|null
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
}
