<?php

namespace app\models;

use mongosoft\file\UploadImageBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $status
 * @property string  $price
 * @property string  $producer
 * @property integer $type_id
 * @property integer $count
 * @property string  $produce_date
 * @property string  $create_time
 * @property string  $update_time
 *
 * @property Type    $type
 *
 * @method string getThumbUploadUrl($attribute, $profile = 'thumb')
 */
class Product extends ActiveRecord
{
    const STATUS_DISABLE = 0;
    const STATUS_ACTIVE  = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'producer', 'type_id', 'produce_date', 'count'], 'required'],
            [['status', 'type_id'], 'integer'],
            [['count'], 'integer', 'min' => 1],
            [['price'], 'number', 'min' => 0],
            [['producer'], 'string'],
            [['produce_date', 'create_time', 'update_time'], 'safe'],
            [
                ['type_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Type::className(),
                'targetAttribute' => ['type_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'status'       => Yii::t('app', 'Status'),
            'price'        => Yii::t('app', 'Price'),
            'producer'     => Yii::t('app', 'Producer'),
            'type_id'      => Yii::t('app', 'Type'),
            'count'        => Yii::t('app', 'Count'),
            'produce_date' => Yii::t('app', 'Produce Date'),
            'create_time'  => Yii::t('app', 'Create Time'),
            'update_time'  => Yii::t('app', 'Update Time'),
            'category_id'  => Yii::t('app', 'Category'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (null === $this->status) {
            $this->status = self::STATUS_ACTIVE;
        }

        if ($this->produce_date) {
            $dateTime           = new \DateTime($this->produce_date);
            $this->produce_date = $dateTime->format('Y-m-d');
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return array
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE  => Yii::t('app', 'Active'),
            self::STATUS_DISABLE => Yii::t('app', 'Disabled'),
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        $statuses = self::getStatusArray();

        if (isset($statuses[$this->status])) {
            return $statuses[$this->status];
        } else {
            return Yii::t('app', '-undefined-');
        }
    }
}
