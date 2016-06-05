<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\assets\Highlight;

/**
 * @var yii\web\View
 * @var common\models\Article
 */

Highlight::register($this);
?>

<hr/>
<div class="article-item">
    <h2 class="article-title">
        <?= Html::a($model->title, ['view', 'slug' => $model->slug]) ?>
    </h2>

  

    <div class="article-text">
        <?= HtmlPurifier::process(substr ($model->preview,0,500)) ?>
    </div>

    <?php if ($model->tagValues) : ?>
        <div class="article-meta">
            <span class="glyphicon glyphicon-tags"></span> <?= $model->tagLinks ?>
        </div>
    <?php endif ?>
</div>
