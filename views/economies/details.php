<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var string $economy */
/** @var string $slug */
/** @var array $e_models */
/** @var array $d_models */

$this->title = $economy;
?>
<div class="container-xxl my-3">
    <div class="row mt-3 justify-content-center justify-content-lg-between">
        <div class="col-sm-8 col-md-4 col-lg-3 col-xl-2 mb-2 mb-md-0">
            <div class="accordion accordion-flush" id="accordion1">
                <div class="accordion-item bg-light border-0">
                    <h3 class="accordion-header">
                        <button class="accordion-button p-2 fs-5 collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseOne"
                            aria-expanded="false"
                            aria-controls="collapseOne">
                            Economies
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordion1">
                    <div class="accordion-body">
                        <div class="list-group list-group-flush">
                            <?php foreach ($e_models as $item) : ?>
                                <?= Html::a(
                                    $item['economy']['economy_name'],
                                    ['economies/details', 'slug' => $item['economy']['slug']],
                                    ['class' => 'list-group-item list-group-item-action']
                                ); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="row flex-column align-content-center">
                <div class="col-sm-8 col-md-12 text-center">
                    <div class="text-center">
                        <?php
                        $options = ['class' => 'align-self-top bg-light fw-bold text-uppercase rounded-1 p-2'];
                        Html::addCssClass($options, "text-$slug $slug-shadow");
                        echo Html::tag('h2', $economy, $options);
                        ?>
                    </div>
                </div>
                <div class="col-sm-8 col-md-12">
                    <div class="row flex-column flex-md-row align-content-md-center justify-content-md-around">
                        <div class="col-md-6 col-lg-6 d-flex d-lg-block px-md-3 mb-1 mb-md-0">
                            <div class="w-100">
                                <div class="p-2 bg-secondary">
                                    <span class="position-relative d-inline text-light fw-bold fs-4 pt-2">Import</span>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($d_models['import'] as $key => $value) : ?>
                                        <li class="list-group-item"><?= $value ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 d-flex d-lg-block px-md-3">
                            <div class="w-100">
                                <div class="p-2 bg-secondary">
                                    <span class="position-relative d-inline text-light fw-bold fs-4 pt-2">Export</span>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($d_models['export'] as $key => $value) : ?>
                                        <li class="list-group-item"><?= $value ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
