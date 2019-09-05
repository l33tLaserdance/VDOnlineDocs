<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Switchboard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="switchboard-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'connected_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model_connected_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_connected_to')->widget(\yii\widgets\MaskedInput::className(),[
                                                    'clientOptions' => [
                                                        'alias' => 'ip',
                                                        'groupSeparator' => '.',
                                                        'autoGroup' => true,
                                                    ],
                                                ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'functional')->dropDownList([
		'0' => 'Нет',
		'1' => 'Да',
	]);  ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
