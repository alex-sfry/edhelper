<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\SupplyDemand[] $models */

$this->title = 'Economies';
// d($models, false);
?>
<div class="container-xxl mt-3">
    <h1 class="text-center text-light"><?= $this->title ?></h1>
    <div class="row my-3 justify-content-center">
        <div class="col-7 col-sm-4 col-md-3 col-lg-2">
            <div class="list-group list-group-flush">
                <?php foreach ($models as $item) : ?>
                    <?= Html::a(
                        $item->economy->economy_name,
                        ['trading/details', 'slug' => strtolower($item->economy->slug)],
                        ['class' => 'list-group-item list-group-item-action']
                    ); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>