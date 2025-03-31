<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

/** @var DOMNode[] $economies */

$this->title = 'Economies';
?>
<div class="container-xxl text-light mt-3">
    <h1 class="text-center"><?= $this->title ?></h1>
    <div class="row mt-3 justify-content-center">
        <div class="col-7 col-sm-4 col-md-3 col-lg-2">
            <div class="list-group list-group-flush">
                <?php foreach ($economies as $item) : ?>
                    <a
                        href="<?= Url::to([
                            'economies/details',
                            'slug' => $item->attributes->getNamedItem('slug')->nodeValue
                        ]) ?>"
                        class="list-group-item list-group-item-action"><?= $item->nodeValue ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>