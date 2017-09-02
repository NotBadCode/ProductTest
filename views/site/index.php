<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = Yii::$app->params['siteName'];
?>
<div class="site-index">
    <h1 class="text-center">
        <?= Html::encode($this->title) ?>!
    </h1>
    <h2 class="text-center">
        <a href="<?= Url::to(['product/index']) ?>">
            <?= Yii::t('app', 'Products') ?>
        </a>
    </h2>
</div>