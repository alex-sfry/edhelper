<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SupplyDemand $model */

$this->title = 'Create Supply Demand';
$this->params['breadcrumbs'][] = ['label' => 'Supply Demands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-demand-create">
    <?php if (!empty($exiting_ids)) : ?>
        <div class="text-center mt-1">
            <?php foreach ($exiting_ids as $item) : ?>
                <p class=" bg-light text-danger fw-bold fs-5 p-1"><?= "id $item already exists" ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <h1 class="text-light text-center mt-3"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_adv_form', [
        'model' => $model,
    ]) ?>

</div>
