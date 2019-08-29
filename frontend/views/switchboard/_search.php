<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwitchboardSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="switchboard-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'switch_id') ?>

    <?= $form->field($model, 'device_id') ?>

    <?= $form->field($model, 'switch_name') ?>

    <?= $form->field($model, 'switch_model') ?>

    <?= $form->field($model, 'switch_ip') ?>

    <?php // echo $form->field($model, 'port') ?>

    <?php // echo $form->field($model, 'connected_to') ?>

    <?php // echo $form->field($model, 'model_connected_to') ?>

    <?php // echo $form->field($model, 'ip_connected_to') ?>

    <?php // echo $form->field($model, 'Comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
