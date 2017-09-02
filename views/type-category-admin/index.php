<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Type Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Type Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
                             'dataProvider' => $dataProvider,
                             'columns'      => [
                                 'id',
                                 'title',
                                 [
                                     'class'    => 'yii\grid\ActionColumn',
                                     'template' => '{update} {delete}',
                                 ],
                             ],
                         ]); ?>
</div>
