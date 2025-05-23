<?php

/** @var yii\web\View $this */
/** @var app\models\MaterialTraders[] $models */
/** @var yii\data\Pagination $pagination */
/** @var app\models\MaterialTradersSearch $searchModel */

use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;

$th = [
    ['label' => 'material type'],
    ['label' => 'station'],
    ['label' => 'distance to arrival (ls)'],
    ['label' => 'system'],
    ['label' => "distance from {$searchModel->refSystem} (ly)"]
];
$formatter = Yii::$app->formatter;
$formatter->thousandSeparator = ' ';
?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr class="text-nowrap">
                <?php foreach ($th as $item) : ?>
                    <?= Html::tag('th', ucfirst($item['label']), [
                        'scope' => 'col',
                        'class' => 'text-orange border-bottom border-secondary'
                    ]) ?>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($models as $model) : ?>
                <?php
                $sec = e($model->station->system->security->security_level);
                $pop = $formatter->asInteger($model->station->system->population);
                $tooltip = "<div class='text-start'>Security: $sec</div></div><div>Population: $pop</div>";
                ?>
                <tr>
                    <td><?= e($model->material_type) ?></td>
                    <td><?= e($model->station->name) ?></td>
                    <td><?= e($model->station->distance_to_arrival) ?></td>
                    <td>
                        <span
                            style="--bs-border-style: dotted"
                            class="t-tip border-bottom border-light"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            data-bs-title="<?= $tooltip ?>">
                            <?= e($model->station->system->name) ?>
                        </span>
                    </td>
                    <td><?= e($model->distanceFromRef) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    <?= LinkPager::widget([
        'pagination' => $pagination,
        'maxButtonCount' => 5,
        'firstPageLabel' => true,
        'lastPageLabel' => true,
        // 'listOptions' => ['class' => 'pagination'],
    ]) ?>
</div>