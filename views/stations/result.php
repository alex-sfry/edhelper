<?php

/** @var yii\web\View $this */
/** @var app\models\StationsSearch $searchModel */
/** @var app\models\Stations[] $models */
/** @var yii\data\Sort $sort */
/** @var yii\data\Pagination $pagination */

use yii\bootstrap5\LinkPager;

// echo $form->refSystem;
// d($sort->link('distanceFromRef'));
$th = [
    ['label' => 'station'],
    ['label' => 'type'],
    ['label' => 'pad'],
    ['label' => 'distance to arrival', 'sort' => 'distance_to_arrival'],
    ['label' => 'economy'],
    ['label' => 'system'],
    ['label' => "distance from {$searchModel->refSystem} (LY)", 'sort' => 'distanceFromRef']
];
$formatter = Yii::$app->formatter;
$formatter->thousandSeparator = ' ';
?>
<div class="table-responsive">
    <table class="table" data-bs-theme="dark">
        <thead>
            <tr class="text-nowrap">
                <?php foreach ($th as $item) : ?>
                    <th scope="col" class="text-orange text">
                        <?= isset($item['sort']) ? $sort->link($item['sort']) : ucfirst($item['label']) ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($models as $model) : ?>
                <?php
                $sec = e($model->system->security->security_level);
                $pop = $formatter->asInteger($model->system->population);
                $tooltip = "<div class='text-start'>Security: $sec</div></div><div>Population: $pop</div>";
                ?>
                <tr>
                    <td><?= e($model->name) ?></td>
                    <td class="<?= $model->surface ? 'bg-success' : 'bg-primary' ?>">
                        <?= e($model->type) ?>
                    </td>
                    <td><?= e($model->pad) ?></td>
                    <td><?= e($model->distance_to_arrival) . ' ls' ?></td>
                    <td><?= e($model->economyId1->economy_name) ?></td>
                    <td>
                        <span
                            style="--bs-border-style: dotted"
                            class="t-tip border-bottom border-light"
                            data-bs-toggle="tooltip"
                            data-bs-html="true"
                            data-bs-title="<?= $tooltip ?>">
                            <?= e($model->system->name) ?>
                        </span>
                    </td>
                    <td><?= e($model->distanceFromRef) . ' ly' ?></td>
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
        'options' => ['data-bs-theme' => 'dark']
    ]) ?>
</div>