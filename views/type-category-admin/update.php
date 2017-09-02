<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeCategory */

$this->title = Yii::t('app', 'Update Type Category:') . ' ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="type-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form',
                      [
                          'model' => $model,
                      ]) ?>

</div>