<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Organization;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'org_id')->dropDownList(
		ArrayHelper::map(Organization::find()->all(), 'id', 'org_full_name'),
		['prompt' => 'Выберите организацию']
	) ?>

    <?= $form->field($model, 'FIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Positon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
