<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Project;
use common\models\User;
/** @var yii\web\View $this */
/** @var common\models\Tablelists $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php
$admins = User::find()->where(['role' => 'admin'])->all();
$adminList = [];
foreach ($admins as $admin) {
    $adminList[$admin->id] = $admin->id;
}
?>
<div class="tablelists-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->dropDownList(
    \yii\helpers\ArrayHelper::map(\common\models\Project::find()->all(), 'name', 'name'),
    ['prompt' => 'Select Project']
) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by')->dropDownList(
    \yii\helpers\ArrayHelper::map(\common\models\User::find()->where(['role' => ['user', 'employee']])->all(), 'id', 'username'),
    ['prompt' => 'Select User']
) ?>


    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group" style="margin-top:20px;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
