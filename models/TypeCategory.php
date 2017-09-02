<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%type_category}}".
 *
 * @property integer $id
 * @property string  $title
 *
 * @property Type[]  $types
 */
class TypeCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%type_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['category_id' => 'id']);
    }

    /**
     * @param integer|null $id
     * @return array
     */
    public static function getAllArray($id = null)
    {
        $query = self::find();
        if (null !== $id) {
            $query->where(['!=', 'id', $id]);
        }

        return ArrayHelper::map($query->orderBy('id')->asArray()->all(), 'id', 'title');
    }
}
