<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use app\models\Type;
use app\models\TypeCategory;
use app\models\Product;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
                             'dataProvider'     => $dataProvider,
                             'filterModel'      => $searchModel,
                             'pjax'             => true,
                             'resizableColumns' => true,
                             'columns'          => [
                                 'id',
                                 [
                                     'attribute'           => 'type_id',
                                     'format'              => 'raw',
                                     'value'               => function ($model) {
                                         if (null !== $model->type) {
                                             return Html::a($model->type->title,
                                                            Url::to(['type-admin/update', 'id' => $model->type->id]));
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
                                     'width'               => '20%',
                                 ],
                                 [
                                     'attribute'           => 'category_id',
                                     'format'              => 'raw',
                                     'value'               => function ($model) {
                                         if (null !== $model->type && null !== $model->type->category) {
                                             return Html::a($model->type->category->title,
                                                            Url::to([
                                                                        'type-category-admin/update',
                                                                        'id' => $model->type->category->id
                                                                    ]));
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
                                     'width'               => '20%',
                                 ],
                                 [
                                     'attribute' => 'count',
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
                                     'value'     => function ($model) {
                                         return Yii::$app->formatter->asCurrency($model->price);
                                     },
                                     'width'     => '15%',
                                 ],
                                 [
                                     'class'               => 'kartik\grid\EditableColumn',
                                     'attribute'           => 'status',
                                     'value'               => function ($model) {
                                         return $model->statusName;
                                     },
                                     'editableOptions'     => function ($model) {
                                         return [
                                             'formOptions' => [
                                                 'method' => 'post',
                                                 'action' => ['product-admin/ajax-update', 'id' => $model->id]
                                             ],
                                             'attribute'   => 'status',
                                             'value'       => $model->status,
                                             'asPopover'   => false,
                                             'inputType'   => Editable::INPUT_DROPDOWN_LIST,
                                             'data'        => Product::getStatusArray(),
                                             'options'     => ['class' => 'form-control'],
                                         ];
                                     },
                                     'filterType'          => GridView::FILTER_SELECT2,
                                     'filter'              => Product::getStatusArray(),
                                     'filterWidgetOptions' => [
                                         'options'       => [
                                             'placeholder' => Yii::t('app', 'Select a status ...')
                                         ],
                                         'pluginOptions' => ['allowClear' => true],
                                     ]
                                 ],
                                 [
                                     'class'    => 'yii\grid\ActionColumn',
                                     'template' => '{update} {delete}',
                                 ],
                             ],
                         ]); ?>
</div>
