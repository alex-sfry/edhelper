<?php

namespace app\behaviors;

use app\models\Systems;
use InvalidArgumentException;
use yii\base\Behavior;
use yii\db\Expression;

class SystemBehavior extends Behavior
{
    /**
     * @param string $name
     * @return yii\db\Expression
     */
    public function getDistanceToSystemExpression($name)
    {
        $coords = Systems::find()
            ->select(['x', 'y', 'z'])
            ->where(['name' => $name])
            ->asArray()
            ->one();

        if (empty($coords)) {
            $coords = [0, 0, 0];
        }

        extract($coords);

        return new Expression(
            "ROUND(SQRT(POW((systems.x - $x), 2) + POW((systems.y - $y), 2) + POW((systems.z - $z), 2)), 2)"
        );
    }
}
