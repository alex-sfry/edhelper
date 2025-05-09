<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\forms\SupplyDemandForm|app\models\SupplyDemand $form_model */
/** @var bool|null $success */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var array $economies */
?>

<div class="row justify-content-center">
    <div class="col-sm-6 col-md-5 col-lg-4">
        <div class="supply-demand-form bg-light p-2">
            
            <?php if (!empty($success)) : ?>
                <p class="text-success fw-bold">New record(s) created.</p>
            <?php endif; ?>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form
                ->field($form_model, 'commodity', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                ->textInput() ?>
            <?php if (isset($form_model->eco_ids)) : ?>
                <?= $form
                    ->field($form_model, 'eco_ids', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                    ->checkboxList($economies, ['class' => 'd-flex flex-column']) ?>
            <?php else : ?>
                <?= $form
                    ->field($form_model, 'economy_id', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                    ->dropDownList($economies) ?>
            <?php endif; ?>

            <?= $form
                ->field($form_model, 'import_export', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                ->dropDownList(['import' => 'import', 'export' => 'export']) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
