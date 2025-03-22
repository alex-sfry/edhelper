<?php

/** @var yii\web\View $this */
/** @var app\models\Engineers[] $data */

$th = ['name', 'upgrades', 'system', 'station', 'discovery', 'invite', 'unlock'];

$this->title = 'Engineers';
?>
<div class="container-xxl text-light mt-3">
    <h1 class="text-center"><?= $this->title ?></h1>
    <div class="row mt-3">
        <div class="col-3 my-2">
            <div class="input-group input-group-sm" data-bs-theme="dark">
                <label for="" class="input-group-text">Search for upgrades:</label>
                <input type="text" class="search form-control form-control-sm" data-filter-idx="1" autocomplete="off">
            </div>
        </div>
        <div class="table-responsive">
            <table style="--th-bg: var(--bs-table-bg)" id="dataTable"
                class="table table-striped table-bordered table-sm fs-7" data-bs-theme="dark">
                <thead>
                    <tr>
                        <?php foreach ($th as $item) : ?>
                        <th
                            scope="col"
                            class="text-orange rounded-0 text-uppercase border border-2 fw-bold">
                            <?= $item ?>
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
</div>