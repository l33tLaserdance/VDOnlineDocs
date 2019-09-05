<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\DeviceTypes;
use frontend\models\UpsManufacturers;
use frontend\models\Ports;
use kartik\widgets\Typeahead;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devices */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
	)->label('Тип устройства <span class="red">*</span>') ?>
	
	<?php Pjax::begin(); ?>
	
	<?= '<label id="lUPS" class="control-label" style="display: none">Выберите модель ИБП</label>'; ?>
	<?=	Typeahead::widget([
			'name' => 'model',
			'id' => 'UPS',
			'options' => ['placeholder' => 'Начните ввод модели ...', 'style' => 'margin-bottom: 10px; display: none;'],
			'scrollable' => true,
			'pluginOptions' => ['highlight'=>true],
			'dataset' => [
				[
					'remote' => [
						'url' => Url::to(['devices/ups-models']) . '?q=%QUERY',
						'wildcard' => '%QUERY'
					]
				]
			],
	]);?>
	
	<?= '<label id="lPP" class="control-label" style="display: none">Выберите тип патч-панели</label>'; ?>
	<?=	Typeahead::widget([
			'name' => 'model',
			'id' => 'PP',
			'options' => ['placeholder' => 'Начните ввод типа ...', 'style' => 'margin-bottom: 10px; display: none;'],
			'scrollable' => true,
			'pluginOptions' => ['highlight'=>true],
			'dataset' => [
				[
					'remote' => [
						'url' => Url::to(['devices/pp-types']) . '?q=%QUERY',
						'wildcard' => '%QUERY'
					]
				]
			],
	]);?>
	
	<?= $form->field($modelups, 'manufacturer'/*, ['enableClientValidation' => false]*/)->dropDownList(
		ArrayHelper::map(UpsManufacturers::find()->all(), 'id_man', 'upsman_name'),
		['prompt' => 'Выберите производителя',]
	)->label('Производитель ИБП <span class="red">*</span>') ?>
	
	<?= $form->field($modelups, 'model')->textInput()->label('Модель') ?>
	
    <?= $form->field($model, 'device_name')->textInput(['maxlength' => true/*, 'style' => 'display: none'*/])->label('Наименование устройства <span class="red">*</span>'/*, ['style' => 'display: none']*/) ?>

    <?= $form->field($model, 'port')->textInput()->label('Количество портов <span class="red">*</span>') ?>
	
	<?= $form->field($modelpptypes, 'type')->textInput()->label('Укажите новый тип патч-панели <span class="red">*</span>') ?>
	
	<?= $form->field($modelports, 'amount'/*, ['enableClientValidation' => false]*/)->dropDownList(
		ArrayHelper::map(Ports::find()->all(), 'id_port', 'amount'),
		['prompt' => 'Выберите количество портов',]
	)->label('Количество портов <span class="red">*</span>') ?>

	<?= $form->field($model, 'device_switchn')->textInput(['maxlength' => true])->label('Название коммутатора <span class="red">*</span>') ?>
	
	<?= $form->field($model, 'device_ip')->widget(\yii\widgets\MaskedInput::className(),[
                                                    'clientOptions' => [
                                                        'alias' => 'ip',
                                                        'groupSeparator' => '.',
                                                        'autoGroup' => true,
                                                    ],
                                                ])->label('IP-адрес коммутатора <span class="red">*</span>') ?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>
	
	<?php Pjax::end(); ?>
	<?php } ?>
	 
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

var sessionData = '<?php echo $_SESSION['altcase']; ?>';
var ppcount = '<?php if (isset($countpp)) {echo $countpp;} ?>';
var occount = '<?php if (isset($countoc)) {echo $countoc;} ?>';
var upd = '<?php if (isset($update)) {echo "1";} ?>';

$(".field-devices-port").css("display", "none");
$(".field-devices-comment").css("display", "none");
$(".field-devices-device_name").css("display", "none");
$(".field-devices-device_switchn").css("display", "none");
$(".field-devices-device_ip").css("display", "none");
$(".field-upsmodels-manufacturer").css("display", "none");
$(".field-upsmodels-model").css("display", "none");
$(".field-ports-amount").css("display", "none");
$(".field-patchtypes-type").css("display", "none");

$(document).ready(function() {
	if(upd === "1") {
		$(".field-devices-comment").css("display", "block");
	}
	$('#devices-device_type').change(function() {
		if($(this).val() === '') {
			$(".field-devices-port").css("display", "none");
			$(".field-devices-comment").css("display", "none");
			$(".field-devices-device_name").css("display", "none");
			$(".field-devices-device_switchn").css("display", "none");
			$(".field-devices-device_ip").css("display", "none");
			$("#lUPS").css("display", "none");
			$("#UPS").css("display", "none");
			$("#lPP").css("display", "none");
			$("#PP").css("display", "none");
			$("#devices-device_name").val("");
			$(".field-upsmodels-manufacturer").css("display", "none");
			$(".field-upsmodels-model").css("display", "none");
			$(".field-ports-amount").css("display", "none");
			$(".field-patchtypes-type").css("display", "none");
			$("#devices-port").val("");
			$("#ports-amount").val("");
		}
		if($(this).val() === '1') {
			$(".field-devices-comment").css("display", "block");
			$("#lUPS").css("display", "block");
			$("#UPS").css("display", "block");
			$("#lPP").css("display", "none");
			$("#PP").css("display", "none");
			$(".twitter-typeahead").css("position", "relative");
			$(".field-devices-device_name").css("display", "none");
			$(".field-devices-port").css("display", "none");
			$("#devices-device_name").val("");
			$(".field-devices-device_switchn").css("display", "none");
			$(".field-devices-device_ip").css("display", "none");
			$(".field-ports-amount").css("display", "none");
			$(".field-patchtypes-type").css("display", "none");
			$("#devices-port").val("");
			$("#ports-amount").val("");
		} 
		if($(this).val() === '2') {
			$("#lUPS").css("display", "none");
			$("#UPS").css("display", "none");
			$("#lPP").css("display", "none");
			$("#PP").css("display", "none");
			$("#devices-device_name").val("");
			$(".twitter-typeahead").css("position", "fixed");
			$(".field-devices-port").css("display", "none");
			$(".field-devices-comment").css("display", "block");
			$(".field-devices-device_name").css("display", "block");
			$(".field-devices-device_switchn").css("display", "block");
			$(".field-devices-device_ip").css("display", "block");
			$(".field-upsmodels-manufacturer").css("display", "none");
			$(".field-upsmodels-model").css("display", "none");
			$(".field-ports-amount").css("display", "block");
			$(".field-patchtypes-type").css("display", "none");
			$("#devices-port").val("");
			$("#ports-amount").val("");
		}
		if($(this).val() === '3') {
			$("#lUPS").css("display", "none");
			$("#UPS").css("display", "none");
			$("#lPP").css("display", "block");
			$("#PP").css("display", "block");
			$(".twitter-typeahead").css("position", "relative");
			$("#devices-device_name").val(sessionData+'-pp'+ppcount);
			$(".field-devices-port").css("display", "none");
			$(".field-devices-comment").css("display", "block");
			$(".field-devices-device_name").css("display", "block");
			$(".field-devices-device_switchn").css("display", "none");
			$(".field-devices-device_ip").css("display", "none");
			$(".field-upsmodels-manufacturer").css("display", "none");
			$(".field-upsmodels-model").css("display", "none");
			$(".field-devices-device_name").css("display", "none");
			$(".field-ports-amount").css("display", "block");
			$(".field-patchtypes-type").css("display", "none");
			$("#devices-port").val("");
			$("#ports-amount").val("");
		}
		if($(this).val() === '4') {
			$("#lUPS").css("display", "none");
			$("#UPS").css("display", "none");
			$("#lPP").css("display", "none");
			$("#PP").css("display", "none");
			$(".twitter-typeahead").css("position", "relative");
			$("#devices-device_name").val(sessionData+'-oc'+occount);
			$(".field-devices-port").css("display", "none");
			$(".field-devices-comment").css("display", "block");
			$(".field-devices-device_name").css("display", "block");
			$(".field-devices-device_switchn").css("display", "none");
			$(".field-devices-device_ip").css("display", "none");
			$(".field-upsmodels-manufacturer").css("display", "none");
			$(".field-upsmodels-model").css("display", "none");
			$(".field-devices-device_name").css("display", "none");
			$(".field-ports-amount").css("display", "block");
			$(".field-patchtypes-type").css("display", "none");
			$("#devices-port").val("");
			$("#ports-amount").val("");
		} 
	});
	$("#UPS").blur(function() {
		if($(this).val() === ' Другое' || $(this).val() === 'Другое') {
			$(".field-upsmodels-manufacturer").css("display", "block");
			$(".field-upsmodels-model").css("display", "block");
		} else {
			$("#devices-device_name").val($(this).val());
		}
	});
	$("#PP").blur(function() {
		if($(this).val() === ' Другое' || $(this).val() === 'Другое') {
			$(".field-patchtypes-type").css("display", "block");
		} else {
			$("#devices-device_name").val($(this).val());
		}
	});
	$("#ports-amount").change(function() {
		if($(this).val() !== '') {
			var n = document.getElementById("ports-amount").options.selectedIndex;
			var txt = document.getElementById("ports-amount").options[n].text;
			$("#devices-port").val(txt);
		}
	});
	$("#patchtypes-type").focusout(function() {
		if($(this).val() != '') {
			$("#devices-device_name").val($(this).val());
		}
	});
	$("#upsmodels-manufacturer").focusout(function() {
		if($(this).val() != '' && $('#upsmodels-model').val() != '') {
			var n = document.getElementById("upsmodels-manufacturer").options.selectedIndex;
			var txt = document.getElementById("upsmodels-manufacturer").options[n].text;
			var loc = txt + ' ' + $('#upsmodels-model').val();
			$("#UPS").val(loc);
			$("#devices-device_name").val(loc);
		}
	});
	$("#upsmodels-model").focusout(function() {
		if($(this).val() != '' && $('#upsmodels-manufacturer').val() != '') {
			var n = document.getElementById("upsmodels-manufacturer").options.selectedIndex;
			var txt = document.getElementById("upsmodels-manufacturer").options[n].text;
			var loc = txt + ' ' + $(this).val();
			$("#UPS").val(loc);
			$("#devices-device_name").val(loc);
		}
	});
});
</script>
