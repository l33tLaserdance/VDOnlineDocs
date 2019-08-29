<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Optcross */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="optcross-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uplink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'connected_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'functional')->dropDownList([
		'0' => 'Нет',
		'1' => 'Да',
	]);  ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
