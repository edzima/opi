<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\query\ArticleCategoryQuery;

/**
 * This is the model class for table "{{%article_category}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $comment
 * @property integer $parent_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Article[] $articles
 * @property ArticleCategory $parent
 * @property ArticleCategory[] $articleCategories
 */
class ArticleCategory extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
                'immutable' => true,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'required'],
            ['comment', 'string'],
            [['parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
            ['parent_id', 'exist', 'skipOnError' => true, 'targetClass' => self::className(), 'targetAttribute' => ['parent_id' => 'id']],
            ['status', 'default', 'value' => self::STATUS_DRAFT],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('common', 'Title'),
            'slug' => Yii::t('common', 'Slug'),
            'comment' => Yii::t('common', 'Comment'),
            'parent_id' => Yii::t('common', 'Parent'),
            'status' => Yii::t('common', 'Status'),
            'created_at' => Yii::t('common', 'Created at'),
            'updated_at' => Yii::t('common', 'Updated at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }
	
	// search main Parent Id Category
	public function recursive_array_search($needle,$haystack) {
		foreach($haystack as $key=>$value) {
			$current_key=$key;
			if($needle===$value OR (is_array($value) && $this->recursive_array_search($needle,$value) !== false)) {
				return $current_key;
			}
		}
		return false;
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChilds()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ArticleCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleCategoryQuery(get_called_class());
    }
	
	 
	
	public static function getCategoryMenu(array $models = null)
    {
        $items = [];
        if ($models === null) {
            $models = ArticleCategory::find()->where(['parent_id' => null])->with('childs')->orderBy(['id' => SORT_ASC])->active()->all();
        }
        foreach ($models as $model) {
            $items[] = [
                'url' => ['article/category', 'slug' => $model->slug],
                'label' => $model->title,
                'items' => self::getCategoryMenu($model->childs),
            ];
        }

        return $items;
    }
	
	

}
