<?php

use yii\bootstrap\Nav;

/* @var $this yii\web\View */
print_r($menuItems[0]);
//$podCat = var_dump($menuItems[0]);
//print_r($podCat);
?>

<div class="article-category-item">
    <?= Nav::widget([
        'items' => $menuItems,
        'options' => [
            'class' => 'nav-pills',
        ],
    ]) ?>
</div>
