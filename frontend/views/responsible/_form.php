<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Responsible */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responsible-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resp_FIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resp_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resp_email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
