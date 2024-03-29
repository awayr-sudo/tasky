<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;




AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class=" wrap d-flex flex-column h-100">
<?php $this->beginBody() ?>


 <?php  echo $this->render('header'); ?>


<main  class="d-flex"  style="margin-top: 55px;">


 <?php echo $this->render('sidebar') ?>


<div class="content-wrapper p-3">
<?= Alert::widget() ?>
        <?= $content ?>
               
</div>

   
</main>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
