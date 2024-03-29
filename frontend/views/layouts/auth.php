<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

AppAsset::register($this);

$this->beginContent(viewFile: '@frontend/views/layouts/base.php');

?>







<div class="content-wrapper p-3">
<?= Alert::widget() ?>
 <?= $content ?>
               
</div>

   






<?php $this->endContent(); ?>
