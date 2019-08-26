<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CasesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cases-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'case_id') ?>

    <?= $form->field($model, 'obj_id') ?>

    <?= $form->field($model, 'case_num') ?>

    <?= $form->field($model, 'build_num') ?>

    <?= $form->field($model, 'comm_name') ?>

    <?php // echo $form->field($model, 'case_name') ?>

    <?php // echo $form->field($model, 'switch_ip') ?>

    <?php // echo $form->field($model, 'placement') ?>

    <?php // echo $form->field($model, 'expulsion') ?>

    <?php // echo $form->field($model, 'links') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'Comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
