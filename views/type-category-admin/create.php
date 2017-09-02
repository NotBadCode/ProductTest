<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TypeCategory */

$this->title = Yii::t('app', 'Create Type Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
