<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\user;

/** @var yii\web\View $this */
/** @var common\models\attendance $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="attendance-form">

    <?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username'),
    ['prompt' => 'Select User']
) ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checkin')->textInput() ?>

    <?= $form->field($model, 'checkout')->textInput() ?>

    <?= $form->field($model, 'worktime')->textInput() ?>

    <?= $form->field($model, 'attendance_date')->textInput() ?>

    <div class="form-group" style="margin-top:20px;" >
    <?= Html::submitButton('Check In', ['class' => 'btn btn-success', 'name' => 'checkin-button']) ?>
    <?= Html::submitButton('Check Out', ['class' => 'btn btn-danger', 'name' => 'checkout-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
