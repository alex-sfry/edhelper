<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[Economies]].
 *
 * @see Economies
 */
class EconomiesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Economies[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Economies|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Returns array of ['id => 'economy_name'].
     *
     * @return array
     */
    public function economiesList()
    {
        return  ArrayHelper::map(
            Economies::find()->select(['id', 'economy_name'])->where(['not in', 'id', [16, 17, 18]])->asArray()->all(),
            'id',
            'economy_name'
        );
    }
}
