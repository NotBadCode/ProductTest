<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */

?>

<footer class="footer">
    <div class="container">
        <p class="pull-left">
            &copy; <?= Html::encode(Yii::$app->params['siteName']) ?> <?= date('Y') ?>
        </p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>