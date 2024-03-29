<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tablelists $model */

$this->title = 'Create Tablelists';
$this->params['breadcrumbs'][] = ['label' => 'Tablelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tablelists-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
