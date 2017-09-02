<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */

$menuItems[] = ['label' => Yii::t('app', 'Products'), 'url' => ['/product/index']];
if (Yii::$app->user->isGuest) {
    $menuItems[] = [
        'label' => Yii::t('app', 'Login'),
        'url'   => ['/user/security/login']
    ];
} else {
    if (Yii::$app->user->identity->getIsAdmin()) {
        $menuItems['shop']  = [
            'label' => Yii::t('app', 'Shop Admin'),
            'items' => [
                ['label' => Yii::t('app', 'Products'), 'url' => ['/product-admin/index']],
                ['label' => Yii::t('app', 'Types'), 'url' => ['/type-admin/index']],
                ['label' => Yii::t('app', 'Type Categories'), 'url' => ['/type-category-admin/index']],
            ]
        ];
        $menuItems['admin'] = [
            'label' => Yii::t('app', 'Admin'),
            'items' => [
                ['label' => Yii::t('app', 'Users'), 'url' => ['/user/admin/index']],
                ['label' => Yii::t('app', 'Roles'), 'url' => ['/rbac/role/index']]
            ]
        ];
    }
    $menuItems[] = [
        'label' => Yii::$app->user->identity->username,
        'url'   => ['/user/settings/profile']
    ];
    $menuItems[] = (
        '<li>'
        . Html::beginForm(['/user/security/logout'], 'post')
        . Html::submitButton(
            Yii::t('app', 'Logout'),
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>'
    );
}

?>

<header>
    <?php
    NavBar::begin([
                      'brandLabel' => Yii::$app->params['siteName'],
                      'brandUrl'   => Yii::$app->homeUrl,
                      'options'    => [
                          'class' => 'navbar-inverse navbar-fixed-top',
                      ],
                  ]);
    echo Nav::widget([
                         'options' => ['class' => 'navbar-nav navbar-right'],
                         'items'   => $menuItems,
                     ]);
    NavBar::end();
    ?>
</header>
