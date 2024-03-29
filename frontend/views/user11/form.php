<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var ActiveForm $form */

?>

<div class="user-form">
<?php $form = ActiveForm::begin(); ?>



<?=$form->field($model,'id')->textInput() ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>



<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>



<?= $form->field($model, 'status')->dropDownList(
    [User::STATUS_ACTIVE => 'Active', User::STATUS_INACTIVE => 'InActive'],
    ['options' => [User::STATUS_ACTIVE => ['selected' => true]]]
) ?>


<?= $form->field($model, 'role')->dropDownList([
    User::ROLE_USER => 'User',
    User::ROLE_EMPLOYEE => 'Employee',
], ['prompt' => 'Select Role']) ?>



<?= $form->field($model, 'created_at')->textInput() ?>

<?= $form->field($model, 'updated_at')->textInput() ?>

<div class="form-group" style="margin-top:20px;">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>
