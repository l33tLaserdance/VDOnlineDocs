<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Organization;
use frontend\models\Responsible;

/* @var $this yii\web\View */
/* @var $model frontend\models\RespOrg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resp-org-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'org_id')->dropDownList(
		ArrayHelper::map(Organization::find()->all(), 'id', 'org_full_name'),
		['prompt' => 'Выберите организацию']
	) ?>

	<?= $form->field($model, 'resp_id')->dropDownList(
		ArrayHelper::map(Responsible::find()->all(), 'resp_id', 'resp_FIO'),
		['prompt' => 'Выберите ответственного']
	) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
