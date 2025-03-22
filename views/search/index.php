<?php

/** @var array $result */
?>
<?php if (!empty($result)) : ?>
    <?php foreach ($result as $item) : ?>
        <li class="dd-list-item px-1"><?= e($item->name) ?></li>
    <?php endforeach; ?>
<?php else : ?>
    <li><span class="px-1 text-danger fw-bold">Found nothing</span></li>
<?php endif; ?>
