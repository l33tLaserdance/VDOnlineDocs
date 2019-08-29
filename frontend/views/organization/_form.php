<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Organization */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'org_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'org_full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'INN')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'org_address')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
