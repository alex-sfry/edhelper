<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SupplyDemand $model */

$this->title = 'Update Supply Demand: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Supply Demands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="supply-demand-update">

    <h1 class="text-light text-center mt-3"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'economies' => $economies
    ]) ?>

</div>
