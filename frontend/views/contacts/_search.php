<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContactsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'contact_id') ?>

    <?= $form->field($model, 'org_id') ?>

    <?= $form->field($model, 'FIO') ?>

    <?= $form->field($model, 'Phone') ?>

    <?= $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'Positon') ?>

    <?php // echo $form->field($model, 'Comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
