<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class ProductSearch
 *
 * @package app\models
 */
class ProductSearch extends Product
{
    /**
     * @var integer $category_id
     */
    public $category_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'category_id', 'status', 'count'], 'integer'],
            [['title', 'slug', 'image', 'producer', 'produce_date'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array   $params
     * @param boolean $active
     *
     * @return ActiveDataProvider
     */
    public function search($params, $active = false)
    {
        $query = Product::find();
        if ($active) {
            $query->where(['status' => self::STATUS_ACTIVE]);
        }

        $dataProvider = new ActiveDataProvider([
                                                   'query' => $query,
                                               ]);

        $dataProvider->setSort([
                                   'attributes' => [
                                       'id',
                                       'status',
                                       'price',
                                       'producer',
                                       'type_id',
                                       'count',
                                       'produce_date',
                                       'create_time',
                                       'update_time',
                                       'category_id' => [
                                           'asc'  => ['type.category_id' => SORT_ASC],
                                           'desc' => ['type.category_id' => SORT_DESC],
                                       ],
                                   ],
                               ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->joinWith('type');

        if ($this->produce_date) {
            $dateTime = new \DateTime($this->produce_date);
            $query->andFilterWhere(['produce_date' => $dateTime->format('Y-m-d')]);
        }


        $query->andFilterWhere([
                                   'id'               => $this->id,
                                   'status'           => $this->status,
                                   'count'            => $this->count,
                                   'type_id'          => $this->type_id,
                                   'type.category_id' => $this->category_id,
                               ]);

        $query->andFilterWhere(['like', 'producer', $this->producer]);
        $query->andFilterWhere(['like', 'price', $this->price]);

        return $dataProvider;
    }
}
