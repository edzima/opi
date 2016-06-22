<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleCategory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Articles');
echo Yii::$app->request->pathinfo;
$this->params['breadcrumbs'][] = $this->title;
?>


        <div class="col-md-12">
            <?= $this->render(
                '_categoryItem2.php',
                ['menuItems' => $menuItems]
            ) ?>
        </div>
<div class="article-category">
    <h1><?= Yii::t('frontend', ' {title}', ['title' => $model->title]) ?></h1>

    <div class="row">
        <div class="col-md-9">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'summary' => false,
				
            ]) ?>
        </div>

        <div class="col-md-3">
            <?= $this->render(
                '_categoryItem.php',
                ['menuItems' => $menuItems]
            ) ?>
        </div>
		
		<? echo $urlTest;?>
		
	
    </div>
</div>
