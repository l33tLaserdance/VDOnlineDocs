<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ups-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ups_id') ?>

    <?= $form->field($model, 'device_id') ?>

    <?= $form->field($model, 'ups_model') ?>

    <?= $form->field($model, 'max_time') ?>

    <?= $form->field($model, 'battery_exchange') ?>

    <?php // echo $form->field($model, 'Comment') ?>

    <?php // echo $form->field($model, 'upscol') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
