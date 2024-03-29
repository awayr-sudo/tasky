<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\assigntask $model */

$this->title = 'Assign Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Assigntasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assigntask-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
