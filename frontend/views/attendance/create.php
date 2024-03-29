<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\attendance $model */

$this->title = 'Mark Attendance';
$this->params['breadcrumbs'][] = ['label' => 'Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-create">

<div style="text-align: center;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
