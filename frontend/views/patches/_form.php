<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Patches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patches-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patches_type')->textInput() ?>

    <?= $form->field($model, 'ports')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
