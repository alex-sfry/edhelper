<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="lsp-01 d-flex flex-column overflow-x-hidden h-100">
    <?php $this->beginBody() ?>
    <header class="edh-header">
        <?php
        $linkOptions = ['class' => 'nav-link fs-5 fw-bold ms-lg-1'];
        NavBar::begin([
            'brandLabel' => \Yii::$app->name,
            'brandOptions' => ['class' => 'text-orange fs-2 fw-bold'],
            'togglerOptions' => ['class' => 'text-primary bg-orange'],
            'options' => ['class' => 'navbar navbar-expand-lg bg-layout nav-underline'],
        ]);
        echo Nav::widget([
            'items' => [
                [
                    'label' => 'Economies',
                    'url' => ['economies/index'],
                    'active' => \Yii::$app->controller->id === 'economies',
                    'linkOptions' => ['class' => 'nav-link fs-5 fw-bold']
                ],
                [
                    'label' => 'Trading',
                    'url' => ['trading/index'],
                    'active' => \Yii::$app->controller->id === 'trading',
                    'linkOptions' => $linkOptions
                ],
                [
                    'label' => 'Engineers',
                    'url' => ['engineers/index'],
                    'linkOptions' => $linkOptions
                ],
                [
                    'label' => 'Material traders',
                    'url' => ['material-traders/index'],
                    'linkOptions' => $linkOptions
                ],
                [
                    'label' => 'Stations',
                    'url' => ['stations/index'],
                    'linkOptions' => $linkOptions
                ],
            ],
            'options' => ['class' => 'navbar-nav m-auto text-center']
        ]);
        NavBar::end();
        ?>
    </header>
    <main class="flex-shrink-0 flex-grow-1 bg-main">
        <div class="container-xxl">
            <?php if (!empty($this->params['breadcrumbs'])) : ?>
                <div class="d-inline-block bg-light px-1 mt-1">
                    <?= Breadcrumbs::widget([
                        'links' => $this->params['breadcrumbs'],
                        'options' => [
                        'style' => '--bs-breadcrumb-margin-bottom: 0',
                        'class' => 'fw-bold'
                        ]
                    ]) ?>
                </div>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>
    <footer class="bg-layout mt-auto">
        <div class="container-xxl">
            <div class="row py-4">
                <span class="text-orange text-center fw-bold text-uppercase">footer</span>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>