<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tablelists $model */

$this->title = 'Update Table List : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tablelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tablelists-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
