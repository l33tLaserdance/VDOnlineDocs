<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PatchpanelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patch-panel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'patch_id') ?>

    <?= $form->field($model, 'device_id') ?>

    <?= $form->field($model, 'patch_name') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'ports') ?>

    <?php // echo $form->field($model, 'Comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
