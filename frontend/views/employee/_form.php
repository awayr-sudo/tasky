<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Employee;


/** @var yii\web\View $this */
/** @var common\models\employee $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model,'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

 

    <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?> 


  <?= $form->field($model, 'user_id')->dropDownList(
    ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username'),
    ['prompt' => 'Select User']
) ?>

    <div class="form-group" style="margin-top:20px;">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
