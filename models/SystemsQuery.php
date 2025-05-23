<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Systems]].
 *
 * @see Systems
 */
class SystemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Systems[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Systems|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
