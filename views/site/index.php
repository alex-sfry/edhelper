<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$this->title = 'My Yii Application';
?>
<div class="container-xxl mt-5">
    <div class="row flex-column align-content-center px-2">
        <div class="col-lg-4 col-sm-6 p-2">
            <?= Html::a('economies', ['economies/index'], [
                'class' => 'btn btn-success w-100 text-center px-1 py-5 fw-bold text-nowrap text-uppercase'
            ]) ?>
        </div>
        <div class="col-lg-4 col-sm-6 p-2">
            <?= Html::a('engineers', ['engineers/index'], [
                'class' => 'btn btn-success w-100 text-center px-1 py-5 fw-bold text-nowrap text-uppercase'
            ]) ?>
        </div>
        <div class="col-lg-4 col-sm-6 p-2">
            <?= Html::a('material traders', ['material-traders/index'], [
                'class' => 'btn btn-success w-100 text-center px-1 py-5 fw-bold text-nowrap text-uppercase'
            ]) ?>
        </div>
        <div class="col-lg-4 col-sm-6 p-2">
            <?= Html::a('stations', ['stations/index'], [
                'class' => 'btn btn-success w-100 text-center px-1 py-5 fw-bold text-nowrap text-uppercase'
            ]) ?>
        </div>
    </div>
</div>
