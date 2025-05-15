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
        <!-- <nav class="navbar navbar-expand-lg bg-layout">
            <div class="container-xxl">
                <div>
                    <a class="navbar-brand text-orange fs-1 fw-bold" href="/trading/">
                        EDH
                    </a>
                </div>
                <button
                    class="navbar-toggler bg-orange"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse text-center d-lg-flex justify-content-center me-lg-5"
                    id="navbarNav">
                    <ul class="navbar-nav me-lg-5">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase fw-bold" aria-current="page" href="/trading/">
                                Home
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> -->
        <?php
        NavBar::begin([
            'brandLabel' => 'EDH',
            'options' => ['class' => 'navbar navbar-expand-lg bg-layout'],
            'brandOptions' => ['class' => 'text-orange fs-2 fw-bold'],
            'togglerOptions' => ['class' => 'text-primary bg-orange'],
        ]);
        echo Nav::widget([
            'items' => [
                // [
                //     'label' => 'Home',
                //     'url' => ['site/index'],
                //     'linkOptions' => ['class' => 'nav-link fs-5 fw-bold']
                // ],
                [
                    'label' => 'Economies',
                    'url' => ['economies/index'],
                    'linkOptions' => ['class' => 'nav-link fs-5 fw-bold']
                ],
                [
                    'label' => 'Trading',
                    'url' => ['trading/index'],
                    'linkOptions' => ['class' => 'nav-link fs-5 fw-bold ms-lg-1']
                ],
                [
                    'label' => 'Engineers',
                    'url' => ['engineers/index'],
                    'linkOptions' => ['class' => 'nav-link fs-5 fw-bold ms-lg-1']
                ],
                [
                    'label' => 'Material traders',
                    'url' => ['material-traders/index'],
                    'linkOptions' => ['class' => 'nav-link fs-5 fw-bold ms-lg-1']
                ],
                [
                    'label' => 'Stations',
                    'url' => ['stations/index'],
                    'linkOptions' => ['class' => 'nav-link fs-5 fw-bold ms-lg-1']
                ],
            ],
            'options' => ['class' => 'navbar-nav m-auto text-center'],
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