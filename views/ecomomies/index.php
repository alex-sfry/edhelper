<?php

/** @var yii\web\View $this */
/** @var app\models\Economies[] $economies */
/** @var app\models\SupplyDemand[] $models */

$list1 = ['An item', 'A second item', 'A third item', 'A fourth item', 'A fourth item', 'And a fifth one'];

$eco_c = [
    'Agriculture' => 'agriculture',
    'Colony' => 'colony',
    'Extraction' => 'extraction',
    'High Tech' => 'high-tech',
    'Industrial' => 'industrial',
    'Military' => 'military',
    'Refinery' => 'refinery',
    'Service' => 'service',
    'Terraforming' => 'terraforming',
    'Tourism' => 'tourism',
    'Prison' => 'prison',
    'Damaged' => 'damaged',
    'Rescue' => 'rescue',
    'Repair' => 'repair',
    'Engineering' => 'engineering',
];

// d($economies[0]->economy_name, false);
// d($models);

$this->title = 'Economies Supply / Demand';
?>

<div class="container-xxl text-light mt-3">
    <h1 class="text-center"><?= $this->title ?></h1>
    <div class="row mt-3">
        <div class="col-12 rounded-2 bg-dark py-2">
            <ul class="tabs-dark nav nav-pills border-bottom pb-2" data-bs-theme="dark">
                <li class="nav-item">
                    <a class="nav-link fw-bold active" aria-current="page" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Link</a>
                </li>
            </ul>
            <div class="row flex-column flex-md-row align-content-md-center justify-content-md-around">
                <div class="col-12 col-md-4">
                    <h3 class="import-export position-relative d-inline fw-bold pt-2">Import</h3>
                    <ul class="list-group list-group-flush" data-bs-theme="dark">
                        <?php foreach ($list1 as $item) : ?>
                        <li class="list-group-item"><?= e($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-center my-5 my-md-0">
                    <h2
                        class="d-inline-block align-self-center text-high-tech high-tech-shadow fw-bold text-uppercase rounded-1 p-2">
                        High Tech
                    </h2>
                </div>
                <div class="col-12 col-md-4">
                    <h3 class="import-export position-relative d-inline fw-bold pt-2">Export</h3>
                    <ul class="list-group list-group-flush" data-bs-theme="dark">
                        <?php foreach ($list1 as $item) : ?>
                        <li class="list-group-item"><?= e($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>