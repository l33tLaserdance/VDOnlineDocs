<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsManufacturers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ups-manufacturers-form">
	<?php if ($model->id_man != 4) { ?>
	
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'upsman_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	
	<?php } else { ?>
		<p class="lead">Данное поле нельзя удалить или отредактировать, оно необходимо для работы некоторых скриптов</p>
	<?php } ?>
</div>
