<?php

use app\models\SupplyDemand;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SupplyDemandSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Supply Demands';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-demand-index">
    <h1 class="text-light"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Supply Demand', ['supply-demand/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summaryOptions' => ['class' => 'summary text-light'],
        'pager' => ['class' => 'yii\bootstrap5\LinkPager'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'commodity',
            'economy_id',
            [
                'attribute' => 'economy.economy_name',
                'filter' => $economies,
                'filterInputOptions' => ['class' => 'form-select']
            ],
            'import_export',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, SupplyDemand $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
    <?php  ?>
</div>