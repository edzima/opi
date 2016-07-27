<?php

use yii\bootstrap\Nav;

/* @var $this yii\web\View */

?>

<div class="article-category-item">
    <?= Nav::widget([
        'items' => $menuItems,
        'options' => [
            'class' => 'nav-pills',
        ],
		'activateParents' => 'true'
    ]) ?>
</div>
