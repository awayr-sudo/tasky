<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\user;

/** @var yii\web\View $this */
/** @var common\models\Project $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'assigned_to')->dropDownList(
    \yii\helpers\ArrayHelper::map(\common\models\User::find()->where(['role' => ['user', 'employee']])->all(), 'id', 'username'),
    ['prompt' => 'Select User']
) ?>
    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
