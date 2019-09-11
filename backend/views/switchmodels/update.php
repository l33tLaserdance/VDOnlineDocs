<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwitchModels */

$this->title = 'Редактирование модели: ' . $model->model;
$this->params['breadcrumbs'][] = ['label' => 'Модели коммутаторов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->model, 'url' => ['view', 'id' => $model->id_switchmod], 'style' => 'color: green'];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="switch-models-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
