<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-lg navbar-dark bg-ocean-blue fixed-top shadow-sm', 
    ],
]);

$menuItems = [
  
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'], 'linkOptions' => ['class' => 'btn btn-link text-decoration-none text-white']];
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup'], 'linkOptions' => ['class' => 'btn btn-link text-decoration-none text-white']];
} else {
    $menuItems[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => [
            'class' => 'btn btn-link text-decoration-none text-white',
            'data' => [
                'method' => 'post',
            ],
        ],
    ];
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
    'items' => [],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-auto'], 
    'items' => $menuItems,
]);

NavBar::end();
