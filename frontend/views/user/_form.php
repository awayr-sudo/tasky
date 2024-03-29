<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/** @var yii\web\View $this */
/** @var common\models\user $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'role')->dropDownList([
    User::ROLE_USER => 'User',
    User::ROLE_EMPLOYEE => 'Employee',
], ['prompt' => 'Select Role']) ?>

   <?= $form->field($model, 'Password')->passwordInput() ?>

    <div class="form-group" style="margin-top:20px;">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
