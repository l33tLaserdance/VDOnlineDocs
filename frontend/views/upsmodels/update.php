<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsModels */

$this->title = 'Редактирование модели ИБП: ' .$model->model;
$this->params['breadcrumbs'][] = ['label' => 'Список моделей ИБП', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->model, 'url' => ['view', 'id' => $model->id_upsmod], 'style' => 'color: green'];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="ups-models-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
