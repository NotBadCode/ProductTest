<?php

/* @var $this \yii\web\View */

/* @var $content string */

use kartik\growl\Growl;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<?= $this->render('_header') ?>

<div class="main-content">
    <div class="container">
        <?= Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
        <?= $content ?>
    </div>
</div>

<?= $this->render('_footer') ?>

<?php foreach (Yii::$app->session->getAllFlashes() as $key => $message): ?>
    <?= Growl::widget([
                          'type'          => Growl::TYPE_SUCCESS,
                          'icon'          => 'glyphicon glyphicon-ok-sign',
                          'title'         => 'Note',
                          'showSeparator' => true,
                          'body'          => $message
                      ]); ?>
<?php endforeach; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
