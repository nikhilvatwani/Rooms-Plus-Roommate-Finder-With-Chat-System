<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\web\Session;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        .navbar-inverse{
            background-color: white;
            border-color:white;
        }
        .navbar-inverse .navbar-nav > li > a{
            color : black;
            font-size:15px;
            border-bottom-left-radius:15px; 
            border-bottom-right-radius:15px;
            margin-left:10px;
            margin-top: -5px;
        }
        .navbar-right{
            margin-right:17%;
        }
        .navbar-inverse .navbar-nav > li > a:hover{
            background-color:#9E3A3A; 
        }
        .navbar-inverse .navbar-nav > .active > a{
            background-color:#9E3A3A;
        }
        .navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover{
            background-color:#9E3A3A; 
            border-bottom-left-radius:15px; 
            border-bottom-right-radius:15px;
            margin-left:10px;
        }
        .navbar-brand > img{
            margin-top:-10px;
        }
    </style>
    <script>
    $(document).ready(function(){
        $('.navbar-inverse .navbar-nav > li > a').mouseenter(function(){
            $(this).animate({top: '5px',height: "55px"});
        });
        $('.navbar-inverse .navbar-nav > li > a').mouseleave(function(){
            $(this).animate({top: '0px',height: "55px"});
        });
    });
</script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('http://localhost/advaced/home/images/logo1.png'),
        'brandUrl' => 'http://localhost/advaced/backend/web/index.php?r=site/mainhome',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/mainhome']],
    ];
    if(isset(Yii::$app->session['admin'])){
        $menuItems[] = ['label' => 'Customers', 'url' => ['/site/customer']];
        $menuItems[] = ['label' => 'Partners', 'url' => ['/site/partner']];
        $menuItems[] = ['label' => 'All Interested', 'url' => ['/site/all-interested']];
        $menuItems[] = ['label' => 'All Queries', 'url' => ['/site/all-queries']];
    }
    if(isset(Yii::$app->session['customer']) ){
        $menuItems[] = ['label' => 'View Rooms', 'url' => ['/site/filter']];
    }
    if(isset(Yii::$app->session['customer']) || isset(Yii::$app->session['partner'])){
        $menuItems[] = ['label' => 'Message', 'url' => ['/site/to']];
        $menuItems[] = ['label' => 'Interested', 'url' => ['/site/interest']];
        $menuItems[] = ['label' => 'Profile', 'url' => ['/site/view']];
    }
    if (!isset(Yii::$app->session['role'])) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/credintials/login']];
    } else {
        $menuItems[] = ['label' => 'Logout', 'url' => ['/credintials/logout']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
