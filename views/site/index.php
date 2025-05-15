<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$this->title = 'Elite Dangerous Helper';
?>
<div class="row flex-column align-content-center px-2 mt-5">
    <div class="col-lg-4 col-sm-6 p-2">
        <?= Html::a('economies', ['economies/index'], [
            'class' => 'btn btn-success w-100 text-center py-3 fw-bold text-nowrap text-uppercase'
        ]) ?>
    </div>
    <div class="col-lg-4 col-sm-6 p-2">
        <?= Html::a('trading', ['trading/index'], [
            'class' => 'btn btn-success w-100 text-center py-3 fw-bold text-nowrap text-uppercase'
        ]) ?>
    </div>
    <div class="col-lg-4 col-sm-6 p-2">
        <?= Html::a('engineers', ['engineers/index'], [
            'class' => 'btn btn-success w-100 text-center py-3 fw-bold text-nowrap text-uppercase'
        ]) ?>
    </div>
    <div class="col-lg-4 col-sm-6 p-2">
        <?= Html::a('material traders', ['material-traders/index'], [
            'class' => 'btn btn-success w-100 text-center py-3 fw-bold text-nowrap text-uppercase'
        ]) ?>
    </div>
    <div class="col-lg-4 col-sm-6 p-2">
        <?= Html::a('stations', ['stations/index'], [
            'class' => 'btn btn-success w-100 text-center py-3 fw-bold text-nowrap text-uppercase'
        ]) ?>
    </div>
</div>
