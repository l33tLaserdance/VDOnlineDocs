<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\UpsManufacturers;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsModels */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ups-models-form">
	<?php if ($model->id_upsmod != 5) { ?>
	
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'manufacturer')->dropDownList(
		ArrayHelper::map(UpsManufacturers::find()->all(), 'id_man', 'upsman_name'),
		['prompt' => 'Выберите производителя']
	) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	
	<?php } else { ?>
		<p class="lead">Данное поле нельзя удалить или отредактировать, оно необходимо для работы некоторых скриптов</p>
	<?php } ?>
</div>
