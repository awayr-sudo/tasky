<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Employee;


/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var ActiveForm $form */



?>


<div class="user-form">
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'username')->dropDownList(
    \yii\helpers\ArrayHelper::map(Employee::find()->all(), 'name', 'name'),
    ['prompt' => 'Select Username']
) ?>
<?= $form->field($model, 'email')->dropDownList(
    \yii\helpers\ArrayHelper::map(Employee::find()->all(), 'email_address', 'email_address'),
    ['prompt' => 'Select Email']
) ?>

<?= $form->field($model, 'status')->dropDownList(
    [User::STATUS_ACTIVE => 'Active', User::STATUS_INACTIVE => 'InActive'],
    ['options' => [User::STATUS_ACTIVE => ['selected' => true]]]
) ?>


<?= $form->field($model, 'role')->dropDownList([
    User::ROLE_USER => 'User',
    User::ROLE_EMPLOYEE => 'Employee',
], ['prompt' => 'Select Role']) ?>


<?= $form->field($model, 'Password')->passwordInput() ?>





    <div class="form-group" style="margin-top:20px;">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


