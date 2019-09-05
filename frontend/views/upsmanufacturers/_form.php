<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsManufacturers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ups-manufacturers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'upsman_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
