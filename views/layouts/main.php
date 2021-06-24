<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
        ],
    ]);
    $menuItems = [
        [
            'label' => 'Главная',
            'url' => ['site/index'],
            'visible' => true
        ],
        [
            'label' => 'Настройка парсера',
            'url' => ['site/parser-setting'],
            'visible' => !Yii::$app->user->isGuest
        ],
        [
            'label' => 'Результаты парсинга',
            'url' => ['site/parser-view'],
            'visible' => !Yii::$app->user->isGuest
        ],
        [
            'label' => 'Логи запросов парсера',
            'url' => ['site/request-logs'],
            'visible' => !Yii::$app->user->isGuest
        ],
        [
            'label' => 'Вход',
            'url' => ['site/login'],
            'visible' => Yii::$app->user->isGuest
        ],
        [
            'label' => 'Выход',
            'url' => ['site/logout'],
            'visible' => !Yii::$app->user->isGuest
        ]
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => array_filter($menuItems, function($item) {
            return $item['visible'];
        }),
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
