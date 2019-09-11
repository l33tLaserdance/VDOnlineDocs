<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Patches */

$this->title = 'Редактирование записи: патч-панель ' . $model->id_patches;
$this->params['breadcrumbs'][] = ['label' => 'Патч-панели', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_patches, 'url' => ['view', 'id' => $model->id_patches]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="patches-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
