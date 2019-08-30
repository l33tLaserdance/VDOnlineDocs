<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ResponsibleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responsible-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'resp_id') ?>

    <?= $form->field($model, 'resp_FIO') ?>

    <?= $form->field($model, 'resp_phone') ?>

    <?= $form->field($model, 'resp_email') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
