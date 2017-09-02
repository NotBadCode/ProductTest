<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
                             'dataProvider' => $dataProvider,
                             'columns'      => [
                                 'id',
                                 'title',
                                 [
                                     'attribute' => 'category_id',
                                     'format'    => 'raw',
                                     'value'     => function ($model) {
                                         if (null !== $model->category) {
                                             return Html::a($model->category->title,
                                                            Url::to([
                                                                        'type-category-admin/update',
                                                                        'id' => $model->category->id
                                                                    ]));
                                         } else {
                                             return Yii::t('app', '-undefined-');
                                         }
                                     }
                                 ],
                                 [
                                     'class'    => 'yii\grid\ActionColumn',
                                     'template' => '{update} {delete}',
                                 ],
                             ],
                         ]); ?>
</div>
