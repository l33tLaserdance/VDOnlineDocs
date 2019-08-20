<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Objects;

/* @var $this yii\web\View */
/* @var $model frontend\models\Objects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'org_id')->hiddenInput([
										'maxlength' => true,
										//'disabled' => true,
										'label' => false,
										'value' => $_GET['id'],
	
	])->label(false) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
