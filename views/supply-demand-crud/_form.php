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

            <?php /* echo $form
                ->field($model, 'economy_id', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                ->textInput() */ ?>

            <?= $form
                ->field($model, 'economy_id', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                ->label('Economy')
                ->dropDownList($economies) ?>

            <?= $form
                ->field($model, 'import_export', ['labelOptions' => [ 'class' => 'form-label fw-bold']])
                ->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
