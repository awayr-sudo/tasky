<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<style>
    .button-container {
        text-align: center;
        margin-top: 50px;
    }
  
    .action-button {
        width: 200px;
        margin-top: 20px; 
    }
</style>
<div class="button-container">
    <?php $form = ActiveForm::begin(['action' => ['attendance/checkin']]); ?>
        <?= Html::submitButton('Check In', ['class' => 'btn btn-success btn-lg action-button', 'name' => 'checkin-button']) ?>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(['action' => ['attendance/checkout']]); ?>
        <?= Html::submitButton('Check Out', ['class' => 'btn btn-danger btn-lg action-button', 'name' => 'checkout-button']) ?>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(['action' => ['attendance/lunch-break']]); ?>
        <?= Html::submitButton('Lunch Break In', ['class' => 'btn btn-success btn-lg action-button', 'name' => 'lunch-in-button']) ?>
    <?php ActiveForm::end(); ?>
    
    <?php $form = ActiveForm::begin(['action' => ['attendance/break-out']]); ?>
        <?= Html::submitButton('Lunch Break Out', ['class' => 'btn btn-danger btn-lg action-button', 'name' => 'breakout-button']) ?>
    <?php ActiveForm::end(); ?>
</div>

