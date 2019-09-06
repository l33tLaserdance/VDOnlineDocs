<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\SwitchManufacturers;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwitchModels */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="switch-models-form">
	<?php if ($model->id_switchmod != 2) { ?>
	
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'manufacturer')->dropDownList(
		ArrayHelper::map(SwitchManufacturers::find()->all(), 'id_swman', 'swman_name'),
		['prompt' => 'Выберите производителя']
	) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ports')->textInput() ?>

    <?= $form->field($model, 'PoE')->dropDownList([
		'0' => 'Нет',
		'1' => 'Да',
	]); 
	?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
	
    <?php ActiveForm::end(); ?>
	
	<?php } else { ?>
		<p class="lead">Данное поле нельзя удалить или отредактировать, оно необходимо для работы некоторых скриптов</p>
	<?php } ?>
</div>
