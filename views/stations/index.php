<?php

/** @var yii\web\View $this */

use app\assets\AutocompleteAsset;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/** @var app\models\StationsSearch $searchModel */
/** @var app\models\Stations[] $models */

$this->title = 'Stations';
AutocompleteAsset::register($this);
// $this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="text-center text-light mt-3"><?= $this->title ?></h1>
<div class="row mt-3">
    <div class="col-12 col-md-9 col-lg-8">
        <div class="stations-search d-flex">
            <div>
                <button id="filter-btn"
                    class="btn btn-secondary lsp-01 mb-1"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseForm"
                    aria-expanded="false"
                    aria-controls="collapseForm">
                    filter
                </button>
            </div>
            <div id="collapseForm" class="form-filter collapse row w-100 ms-1">
                <div class="col-12">
                    <?php $form = ActiveForm::begin([
                        'id' => 'stations-form',
                        'action' => Url::to(['stations/index']),
                        'method' => 'get',
                        'successCssClass' => null,
                        'options' => ['class' => 'bg-light py-1 px-2 mb-3', 'novalidate' => true]
                    ]); ?>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="ui-front ui-widget">
                                <div class="d-flex align-items-center">
                                    <?= $form
                                        ->field(
                                            $searchModel,
                                            'refSystem',
                                            [
                                                'options' => ['id' => 'cnt-refSystem', 'class' => 'mb-3 w-100'],
                                                'labelOptions' => ['class' => 'form-label'],
                                            ],
                                        )
                                        ->textInput([
                                            'autocomplete' => 'off'
                                        ]) ?>
                                    <div class="spinner spinner-border spinner-border-sm mt-4 visually-hidden"
                                        role="status">
                                    </div>
                                </div>
                            </div>
                            <?= $form
                                ->field($searchModel, 'minPadSize', ['labelOptions' => ['class' => 'form-label']])
                                ->radioList(
                                    ['' => 'S/M', 'L' => 'L'],
                                    [
                                        'class' => 'd-flex',
                                        'separator' => '<span class="mx-2"></span>',
                                        'itemOptions' => ['labelOptions' => ['class' => 'form-check-label']],
                                        'unselect' => null
                                    ]
                                ) ?>
                            <?= $form
                                ->field($searchModel, 'inclSurface', ['labelOptions' => ['class' => 'form-label']])
                                ->radioList(
                                    ['No' => 'No', 'Yes' => 'Yes (w/o Odyssey)'],
                                    [
                                        'class' => 'd-flex',
                                        'separator' => '<span class="mx-2"></span>',
                                        'itemOptions' => ['labelOptions' => ['class' => 'form-check-label']],
                                        'unselect' => null
                                    ]
                                ) ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <?= $form
                                ->field($searchModel, 'economyId1', ['labelOptions' => ['class' => 'form-label']])
                                ->dropDownList(
                                    [
                                        "" => "Any",
                                        1 => "Agriculture",
                                        2 => "Colony",
                                        3 => "Extraction",
                                        4 => "High Tech",
                                        5 => "Industrial",
                                        6 => "Military",
                                        8 => "Refinery",
                                        9 => "Service",
                                        10 => "Terraforming",
                                        11 => "Tourism",
                                    ],
                                    ['class' => 'form-select']
                                ) ?>
                            <?= $form
                                ->field(
                                    $searchModel,
                                    'distance_to_arrival',
                                    ['labelOptions' => ['class' => 'form-label']]
                                ) ?>
                        </div>
                    </div>
                    <div class="text-center mb-1">
                        <?= Html::submitButton('apply filter', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($models)) : ?>
    <?= $this->render(
        'result',
        [
            'searchModel' => $searchModel,
            'models' => $models,
            'sort' => $sort,
            'pagination' => $pagination
        ]
    ); ?>
<?php elseif (isset($models)) : ?>
    <div class="text-center bg-light text-danger fs-5 fw-bold text-uppercase p-2 mt-4">
        found nothing
    </div>
<?php endif; ?>
