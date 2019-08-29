<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_id')->hiddenInput([ 
											'maxlength' => true,
											'label' => false,
											'value' => $model->device_id,
	])->label(false) ?>

    <?= $form->field($model, 'ups_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'battery_exchange')->widget(DatePicker::classname(), [
		'options' => ['placeholder' => 'Введите дату замены аккумулятора'],
			'pluginOptions' => [
				'autoclose'=>true,
				'format' => 'dd-mm-yyyy'
			]
		]);
	?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'upscol')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
