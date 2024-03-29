<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\assigntask $model */
/** @var yii\widgets\ActiveForm $form */
use yii\helpers\ArrayHelper;
use common\models\Employee;

use common\models\Task;




?>

<div class="assigntask-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=$form->field($model,'id')->textInput() ?>

    <?= $form->field($model, 'task_name')->dropDownList(
    \yii\helpers\ArrayHelper::map(Task::find()->all(), 'title', 'title'),
    ['prompt' => 'Select Task']
) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

   
    <?= $form->field($model,'assigned_to_employee')->dropDownList(ArrayHelper::map(Employee::find()->all(), 'id', 'name'),
        ['prompt' => 'Select Employee']) ?>

    <div class="form-group" style="margin-top:20px;">
        <?= Html::submitButton('Assign Task', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
