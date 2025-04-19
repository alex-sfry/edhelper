<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SupplyDemand $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="row justify-content-center">
    <div class="col-sm-6 col-md-5 col-lg-4">
        <div class="supply-demand-form bg-light p-2">

            <?php $form = ActiveForm::begin(); ?>
            <?= $form
                ->field($model, 'commodity', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                ->textInput() ?>
            
            <?= $form
                ->field($model, 'economy_ids', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                ->checkboxList($model->getEconomyList(), ['class' => 'd-flex flex-column']) ?>

            <?= $form
                ->field($model, 'import_export', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                ->dropDownList(['import' => 'import', 'export' => 'export']) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
