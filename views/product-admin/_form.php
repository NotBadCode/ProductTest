<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Product;
use app\models\Type;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'status')->dropDownList(Product::getStatusArray()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'count')
                     ->textInput(['type' => 'number', 'min' => 1, 'value' => 1]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'type_id')->widget(Select2::classname(),
                                                        [
                                                            'data' => Type::getAllArray(),
                                                        ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'producer')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'produce_date')->widget(DatePicker::classname(),
                                                             [
                                                                 'pluginOptions' => [
                                                                     'convertFormat'  => true,
                                                                     'todayHighlight' => true,
                                                                     'format'         => 'yyyy-mm-dd'
                                                                 ]
                                                             ]); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
                               ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
