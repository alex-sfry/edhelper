<?php

use Symfony\Component\VarDumper\VarDumper;
use yii\helpers\Html;

/**
 * Html::encode() wrapper
 *
 * @param string $val
 * @param boolean $doubleEncode
 *
 * @return string
 */
function e($val, $doubleEncode = true)
{
    return Html::encode($val, $doubleEncode);
}

/**
 * VarDumper::dump() wrapper
 *
 * @param mixed $var
 * @param boolean $die
 * @param boolean $highlight
 * @param int $depth
 *
 * @return void
 */
function d($var, $die = true/*, $highlight = true, $depth = 10 */)
{
    // VarDumper::dump($var, $highlight, $depth);
    VarDumper::dump($var);
    $die && die();
}
