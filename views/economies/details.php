<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var DOMNode[] $economies */
/** @var DOMNode[] $import */
/** @var DOMNode[] $export */
/** @var string $economy */

$this->title = 'Economies';
?>
<div class="container-xxl mt-3">
    <h1 class="text-center text-light"><?= $this->title ?></h1>
    <div class="row mt-3 justify-content-center justify-content-lg-between">
        <div class="col-sm-6 col-md-4 col-lg-2 pt-2">
            <div class="bg-secondary text-light fs-5 p-1">Economies</div>
            <div class="list-group list-group-flush">
                <?php foreach ($economies as $item) : ?>
                    <?php
                    $options = ['class' => 'list-group-item list-group-item-action'];
                    if (strtolower($item->nodeValue) === strtolower($economy)) {
                        Html::addCssClass($options, 'active');
                    }
                    echo Html::a(
                        $item->nodeValue,
                        ['economies/details', 'slug' => $item->attributes->getNamedItem('slug')->nodeValue],
                        $options
                    );
                    ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-10 mt-3 mt-lg-0 mb-3">
            <div class="row flex-column flex-md-row align-content-md-center justify-content-md-around py-2 mx-auto">
                <div class="col-md-4 d-flex d-lg-block justify-content-center px-0 px-md-2">
                    <div class="w-100">
                        <div class="p-2 bg-secondary">
                            <span class="position-relative d-inline text-light fw-bold fs-4 pt-2">Import</span>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($import as $node) : ?>
                                <li class="list-group-item"><?= $node->nodeValue ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-center my-5 my-md-0 px-0 px-md-2">
                    <div class="w-100 text-center">
                        <?= Html::tag('h2', $economy, [
                            'class' => "align-self-top $classes bg-light fw-bold text-uppercase rounded-1 p-2"
                        ]); ?>
                    </div>
                </div>
                <div class="col-md-4 d-flex d-lg-block justify-content-center px-0 px-md-2">
                    <div class="w-100">
                        <div class="p-2 bg-secondary">
                            <span class="position-relative d-inline text-light fw-bold fs-4 pt-2">Export</span>
                        </div>
                        <ul class="list-group list-group-flush">
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
