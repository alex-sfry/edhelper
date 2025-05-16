<?php

use app\assets\AutocompleteAsset;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\MaterialTradersSearch $searchModel */
/** @var app\models\MaterialTraders[] $models */

$this->title = 'Material traders';
AutocompleteAsset::register($this);
// $this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="text-center text-light mt-3"><?= e($this->title) ?></h1>
<div class="row mt-3">
    <div class="col-12 col-md-9 col-lg-8">
        <div class="mt-search d-flex">
            <div>
                <button id="filter-btn" class="btn btn-secondary lsp-01 mb-1"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseForm"
                    aria-expanded="false"
                    aria-controls="collapseForm">
                    filter
                </button>
            </div>
            <div id="collapseForm" class="form-filter collapse row w-100 ms-1">
                <div class="col-sm-7 col-md-10 col-lg-8">
                    <?php $form = ActiveForm::begin([
                        'id' => 'mt-form',
                        'action' => Url::to(['material-traders/index']),
                        'method' => 'get',
                        'successCssClass' => null,
                        'options' => [
                            'class' => 'bg-light py-1 px-2 mb-3 rounded-1',
                            'novalidate' => ''
                        ]
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
                                                'labelOptions' => ['class' => 'form-label']
                                            ]
                                        )
                                        ->textInput([
                                            'autocomplete' => 'off'
                                        ]) ?>
                                    <div class="spinner spinner-border spinner-border-sm mt-4 visually-hidden"
                                        role="status">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <?= $form
                                ->field(
                                    $searchModel,
                                    'materialType',
                                    ['labelOptions' => ['class' => 'form-label']]
                                )
                                ->dropDownList(
                                    [
                                        '' => 'Any',
                                        'Raw' => 'Raw',
                                        'Encoded' => 'Encoded',
                                        'Manufactured' => 'Manufactured'
                                    ],
                                    ['class' => 'form-select']
                                ) ?>
                        </div>
                    </div>
                    <div class="text-center mb-1">
                        <?= Html::submitButton(
                            'apply filter',
                            ['class' => 'btn btn-primary lsp-01']
                        ) ?>
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
            'models' => $models,
            'sort' => $sort,
            'pagination' => $pagination,
            'searchModel' => $searchModel,
        ]
    ); ?>
<?php elseif (isset($models)) : ?>
    <div class="text-center bg-light text-danger fs-5 fw-bold text-uppercase p-2 mt-4">
        found nothing
    </div>
<?php endif; ?>
