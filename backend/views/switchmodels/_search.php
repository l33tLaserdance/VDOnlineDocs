<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwitchmodelsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="switch-models-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_switchmod') ?>

    <?= $form->field($model, 'manufacturer') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'ports') ?>

    <?= $form->field($model, 'PoE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
