<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\assets\Highlight;
use rmrevin\yii\module\Comments;


/* @var $this yii\web\View */
/* @var $model common\models\Article */

Highlight::register($this);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">
    <article class="article-item">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="article-meta">
            <span class="glyphicon glyphicon-folder-close"></span> <?= Html::a($model->category->title, ['article/category', 'slug' => $model->category->slug]) ?> 
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="article-text">
                    <?= HtmlPurifier::process($model->preview) ?>
                </div>
				
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
					<li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
					<li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
					<li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
					  <h3>HOME</h3>
					  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
					<div id="menu1" class="tab-pane fade">
					  <h3>Menu 1</h3>
					  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
					<div id="menu2" class="tab-pane fade">
					  <h3>Menu 2</h3>
					  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
					</div>
					<div id="menu3" class="tab-pane fade">
					  <h3>Menu 3</h3>
					  <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
					</div>
				</div>
				
				<?php


				echo Comments\widgets\CommentListWidget::widget([
					'entity' => $model->id, // type and id
				]);
							
			?>
		

                <?php if ($model->tagValues) : ?>
                    <div class="article-meta">
                        <span class="glyphicon glyphicon-tags"></span> <?= $model->tagLinks ?>
                    </div>
                <?php endif ?>

                <hr/>
		
		
		
            </div>
		
        </div>
    </article>
</div>
