<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\DeviceTypes;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devices-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?php if (!isset($model->case_id)) {
    echo $form->field($model, 'case_id')->hiddenInput([
										'maxlength' => true,
										//'disabled' => true,
										'label' => false,
										'value' => $_GET['id'],
	])->label(false); }
	else { echo $form->field($model, 'case_id')->hiddenInput([
										'maxlength' => true,
										//'disabled' => true,
										'label' => false,
										'value' => $model->case_id,
	])->label(false); } ?>
	
	<?php if(isset($update)) { ?>
	
	<?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>
	
	<?php } else { ?>
    <?= $form->field($model, 'device_type')->dropDownList(
		ArrayHelper::map(DeviceTypes::find()->all(), 'dt_id', 'dt_name'),
		['prompt' => 'Выберите тип устройства']
	) ?>

    <?= $form->field($model, 'device_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'port')->textInput() ?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'device_switchn')->textInput(['maxlength' => true])->label('Название коммутатора. Впишите только если добавляемое устройство является коммутатором.') ?>
	
	<?= $form->field($model, 'device_ip')->textInput(['maxlength' => true])->label('IP-адрес коммутатора. Только для коммутаторов.') ?>
	
	<?php } ?>
	
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
