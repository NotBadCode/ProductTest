<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%type}}".
 *
 * @property integer      $id
 * @property string       $title
 * @property integer      $category_id
 *
 * @property Product[]    $products
 * @property TypeCategory $category
 */
class Type extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [
                ['category_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => TypeCategory::className(),
                'targetAttribute' => ['category_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'title'       => Yii::t('app', 'Title'),
            'category_id' => Yii::t('app', 'Category'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TypeCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @param integer|null $id
     * @return array
     */
    public static function getAllArray($id = null)
    {
        $query = self::find()
                     ->select(
                         [
                             'id'    => 'type.id',
                             'title' => new Expression('CONCAT(type.title, " (", type_category.title, ")" )')
                         ])
                     ->joinWith('category');

        if (null !== $id) {
            $query->where(['!=', 'id', $id]);
        }

        $types = $query->orderBy('type.id')->all();

        return ArrayHelper::map($types, 'id', 'title');
    }
}
