<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tablelists $model */

$this->title = 'Create Tasks List';
$this->params['breadcrumbs'][] = ['label' => 'Tablelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tablelists-create" >

<div style="text-align: center;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>





    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
