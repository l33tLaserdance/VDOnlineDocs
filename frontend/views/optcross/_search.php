<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OptcrossSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="optcross-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'optcross_id') ?>

    <?= $form->field($model, 'device_id') ?>

    <?= $form->field($model, 'optcross_name') ?>

    <?= $form->field($model, 'port') ?>

    <?= $form->field($model, 'uplink') ?>

    <?php // echo $form->field($model, 'connected_to') ?>

    <?php // echo $form->field($model, 'Comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
