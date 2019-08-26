<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cases */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cases-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'obj_id')->hiddenInput([
										'maxlength' => true,
										//'disabled' => true,
										'label' => false,
										'value' => $model->obj_id,
	])->label(false) ?>
	
    <?= $form->field($model, 'case_num')->textInput() ?>

    <?= $form->field($model, 'build_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comm_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'case_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'switch_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'placement')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expulsion')->widget(DatePicker::classname(), [
		'options' => ['placeholder' => 'Введите дату продувки'],
			'pluginOptions' => [
				'autoclose'=>true,
				'format' => 'dd-mm-yyyy'
			]
		]);
	?>

    <?= $form->field($model, 'links')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->dropDownList([
		'0' => 'Нет',
		'1' => 'Да',
	]); 
	?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
