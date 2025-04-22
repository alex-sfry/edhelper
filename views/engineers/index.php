<?php

/** @var yii\web\View $this */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var app\models\Engineers[] $data */

$th = ['name', 'upgrades', 'system', 'station', 'discovery', 'invite', 'unlock'];

$this->title = 'Engineers';
?>
<h1 class="text-center text-light mt-3"><?= $this->title ?></h1>
<div class="row mt-3">
    <div class="col-3 my-2">
        <div class="input-group input-group-sm">
            <label for="" class="input-group-text">Search for upgrades:</label>
            <input type="text" class="search form-control form-control-sm" data-filter-idx="1" autocomplete="off">
        </div>
    </div>
    <div class="table-responsive rounded-1">
        <table id="dataTable" class="table table-striped">
            <thead>
                <tr>
                    <?php foreach ($th as $item) : ?>
                        <th scope="col" class="text-orange border-bottom border-secondary">
                            <?= ucfirst($item) ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item) : ?>
                    <tr>
                        <td class="text-nowrap"><?= $item->name ?></td>
                        <td class="text-nowrap">
                            <?php
                            $upgrades = ArrayHelper::getColumn(
                                ArrayHelper::toArray($item->engineersUpgrades),
                                'upgrade'
                            );

                            usort($upgrades, function ($a, $b) {
                                preg_match('/G(\d)/', $a, $matchA);
                                preg_match('/G(\d)/', $b, $matchB);
                                $gradeA = isset($matchA[1]) ? (int)$matchA[1] : 0;
                                $gradeB = isset($matchB[1]) ? (int)$matchB[1] : 0;

                                return $gradeB <=> $gradeA; // Descending order
                            });

                            foreach ($upgrades as $val) {
                                $options = ['class' => 'text-decoration-underline'];
                                str_contains($val, 'G5') && Html::addCssClass($options, 'fw-bold');
                                echo Html::beginTag('span', $options);
                                    echo $val . '<br>';
                                echo Html::endTag('span');
                            }
                            ?>
                        </td>
                        <td><?= $item->system->name ?></td>
                        <td><?= $item->station->name ?></td>
                        <td><?= $item->discovery ?></td>
                        <td><?= $item->get_invite ?></td>
                        <td><?= $item->unlock ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>