<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Objects;

/* @var $this yii\web\View */
/* @var $model frontend\models\Objects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'org_id')->hiddenInput([
										'maxlength' => true,
										//'disabled' => true,
										'label' => false,
										'value' => $_SESSION['org_id'],
	
	])->label(false) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obj_name')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'Comment')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'map')->textInput(['maxlength' => true])->label('<span class="red">Внимание!</span> Для того, чтобы загрузить карту к данному объекту, необходимо создать её в <a href="https://yandex.ru/map-constructor">конструкторе карт Яндекса</a>.
	<br> Размер должен быть 555x555. После сохранения карты и получения её кода необходимо вставить в данном поле показанную на картинке ниже часть кода. Для разных объектов всегда создавайте новую карту!<br><img src="/images/yanmapex.png" style="display: block; margin-left: auto; margin-right: auto;"><br> Код карты Yandex ') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
