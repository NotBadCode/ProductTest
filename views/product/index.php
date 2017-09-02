<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use app\models\Type;
use app\models\TypeCategory;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
                             'dataProvider'     => $dataProvider,
                             'filterModel'      => $searchModel,
                             'pjax'             => true,
                             'resizableColumns' => true,
                             'columns'          => [
                                 [
                                     'attribute'           => 'type_id',
                                     'format'              => 'raw',
                                     'value'               => function ($model) {
                                         if (null !== $model->type) {
                                             return $model->type->title;
                                         } else {
                                             return Yii::t('app', '-undefined-');
                                         }
                                     },
                                     'filterType'          => GridView::FILTER_SELECT2,
                                     'filter'              => Type::getAllArray(),
                                     'filterWidgetOptions' => [
                                         'options'       => [
                                             'placeholder' => Yii::t('app', 'Select a type ...')
                                         ],
                                         'pluginOptions' => ['allowClear' => true],
                                     ],
                                     'width'               => '25%',
                                 ],
                                 [
                                     'attribute'           => 'category_id',
                                     'format'              => 'raw',
                                     'value'               => function ($model) {
                                         if (null !== $model->type && null !== $model->type->category) {
                                             return $model->type->category->title;
                                         } else {
                                             return Yii::t('app', '-undefined-');
                                         }
                                     },
                                     'filterType'          => GridView::FILTER_SELECT2,
                                     'filter'              => TypeCategory::getAllArray(),
                                     'filterWidgetOptions' => [
                                         'options'       => [
                                             'placeholder' => Yii::t('app', 'Select a category ...')
                                         ],
                                         'pluginOptions' => ['allowClear' => true],
                                     ],
                                     'width'               => '25%',
                                 ],
                                 [
                                     'attribute' => 'producer',
                                 ],
                                 [
                                     'attribute'           => 'produce_date',
                                     'format'              => ['date', 'php:d.m.Y'],
                                     'filterType'          => GridView::FILTER_DATE,
                                     'filterWidgetOptions' => [
                                         'options'       => [
                                             'placeholder' => Yii::t('app', 'Select a date ...')
                                         ],
                                         'pluginOptions' => [
                                             'convertFormat'  => true,
                                             'todayHighlight' => true,
                                             'format'         => 'dd.mm.yyyy'
                                         ]
                                     ],
                                     'width'               => '20%',
                                 ],
                                 [
                                     'attribute' => 'price',
                                     'width'     => '15%',
                                 ],
                             ],
                         ]); ?>
</div>
