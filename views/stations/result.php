<?php

/** @var yii\web\View $this */
/** @var app\models\StationsSearch $searchModel */
/** @var app\models\Stations[] $models */
/** @var yii\data\Sort $sort */
/** @var yii\data\Pagination $pagination */

use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;

$th = [
    ['label' => 'station'],
    ['label' => 'type'],
    ['label' => 'pad'],
    ['label' => 'distance to arrival (ls)', 'sort' => 'distance_to_arrival'],
    ['label' => 'economy'],
    ['label' => 'system'],
    ['label' => "distance from {$searchModel->refSystem} (ly)", 'sort' => 'distanceFromRef']
];
$formatter = Yii::$app->formatter;
$formatter->thousandSeparator = ' ';
?>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr class="text-nowrap">
                <?php foreach ($th as $item) : ?>
                    <?= Html::beginTag('th', [
                        'scope' => 'col',
                        'class' => 'text-orange border-bottom border-secondary'
                    ]) ?>
                        <?= isset($item['sort'])
                            ? $sort->link($item['sort'], ['label' => $item['label']])
                            : ucfirst($item['label']) ?>
                    <?= Html::endTag('th') ?>
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

                    <?php
                    $options = ['class' => 'text-light'];
                    if ($model->surface) {
                        Html::addCssClass($options, 'bg-success');
                    } else {
                        Html::addCssClass($options, 'bg-primary');
                    }
                    ?>

                    <?= Html::beginTag('td', $options) ?>
                        <?= e($model->type) ?>
                    <?= Html::endTag('td') ?>

                    <td><?= e($model->pad) ?></td>
                    <td><?= e($model->distance_to_arrival) . ' ls' ?></td>
                    <td><?= e($model->economyId1->economy_name) ?></td>
                    <td>

                        <?= Html::beginTag('span', [
                            'style' => '--bs-border-style: dotted',
                            'class' => 't-tip border-bottom border-dark',
                            'data-bs-toggle' => 'tooltip',
                            'data-bs-html' => 'true',
                            'data-bs-title' => $tooltip
                        ]) ?>
                            <?= e($model->system->name) ?>
                        <?= Html::endTag('span') ?>

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
        // 'listOptions' => ['class' => 'pagination']
    ]) ?>
</div>