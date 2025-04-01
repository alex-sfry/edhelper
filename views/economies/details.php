<?php

use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var DOMNode[] $economies */
/** @var DOMNode[] $import */
/** @var DOMNode[] $export */
/** @var string $economy */

$this->title = 'Economies';
?>
<div class="container-xxl text-light mt-3">
    <h1 class="text-center"><?= $this->title ?></h1>
    <div class="row mt-3 justify-content-center justify-content-lg-between">
        <div class="col-12 col-lg-2">
            <div class="list-group list-group-flush">
                <?php foreach ($economies as $item) : ?>
                    <?php $cls = strtolower($item->nodeValue) === strtolower($economy) ? ' active' : '' ?>
                    <a
                        href="<?= Url::to([
                            'economies/details',
                            'slug' => $item->attributes->getNamedItem('slug')->nodeValue
                        ]) ?>"
                        class="list-group-item list-group-item-action<?= $cls ?>"><?= $item->nodeValue ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-12 col-lg-10 mt-3 mt-lg-0 mb-3">
            <div class="row flex-column flex-md-row align-content-md-center justify-content-md-around bg-dark py-2 mx-auto">
                <div class="col-12 col-md-4 d-flex d-lg-block justify-content-center">
                    <div>
                        <h3 class="import-export position-relative d-inline fw-bold pt-2">Import</h3>
                        <ul class="list-group list-group-flush" data-bs-theme="dark">
                            <?php foreach ($import as $node) : ?>
                                <li class="list-group-item"><?= $node->nodeValue ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex justify-content-center my-5 my-md-0">
                    <div>
                        <h2 class="align-self-top mt-3 <?= $classes ?> fw-bold text-uppercase rounded-1 p-2"><?= $economy ?></h2>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex d-lg-block justify-content-center">
                    <div>
                        <h3 class="import-export position-relative d-inline fw-bold pt-2">Export</h3>
                        <ul class="list-group list-group-flush" data-bs-theme="dark">
                            <?php foreach ($export as $node) : ?>
                                <li class="list-group-item"><?= $node->nodeValue ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
