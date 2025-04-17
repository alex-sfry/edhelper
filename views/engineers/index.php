<?php

/** @var yii\web\View $this */
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
        <table id="dataTable"
            class="table table-striped">
            <thead>
                <tr>
                    <?php foreach ($th as $item) : ?>
                    <th
                        scope="col"
                        class="text-orange border-bottom border-secondary">
                        <?= ucfirst($item) ?>
                    </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $item) : ?>
                <tr>
                    <td><?= $item->name ?></td>
                    <td>
                        <?php foreach ($item->engineersUpgrades as $val) : ?>
                        <span class="text-decoration-underline"><?= $val->upgrade ?></span><br>
                        <?php endforeach; ?>
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