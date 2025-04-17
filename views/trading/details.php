<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var string $economy */
/** @var string $slug */
/** @var array $economies_model */
/** @var array $target_e_models */

$this->title = $economy;
// d($target_e_models);
?>
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
                        <?php foreach ($economies_model as $item) : ?>
                            <?= Html::a(
                                $item['economy']['economy_name'],
                                ['trading/details', 'slug' => strtolower($item['economy']['slug'])],
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
        <div class="row flex-column">
            <div class="col-sm-8 col-md-10 text-center">
                <div class="text-center">
                    <?php
                    $options = ['class' => 'align-self-top bg-light fw-bold text-uppercase rounded-1 p-2'];
                    Html::addCssClass($options, "text-$slug $slug-shadow");
                    echo Html::tag('h2', $economy, $options);
                    ?>
                </div>
            </div>
            <div class="col-sm-8 col-md-10">
                <div class="text-center mb-2">
                    <?php if (!empty($target_e_models)) : ?>
                        <button id="btn-mean-prices" class="btn btn-primary">load mean prices</button>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table fw-bold">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="border-bottom border-dark text-orange text-uppercase">
                                        Buy
                                </th>
                                <th scope="col"
                                class="border-bottom border-dark text-orange text-uppercase">
                                    Sell at
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php ksort($target_e_models) ?>
                            <?php foreach ($target_e_models as $key => $value) : ?>
                                <tr>
                                    <?= Html::tag('td', "$key <span class='text-primary'></span>", [
                                        'rowspan' => count($value) + 1,
                                        'class' => "c-exp-name",
                                        'data-name' => strtolower($key)
                                    ]); ?>
                                </tr>
                                <?php asort($value); ?>
                                <?php foreach ($value as $item) : ?>
                                    <tr>
                                        <?php $cls = str_replace(' ', '-', strtolower($item)); ?>
                                        <?= Html::tag('td', $item, ['class' => "text-$cls $cls-shadow"]); ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

