<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsManufacturers */

$this->title = 'Редактирование производителя: ' . $model->upsman_name;
$this->params['breadcrumbs'][] = ['label' => 'Производители ИБП', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->upsman_name, 'url' => ['view', 'id' => $model->id_man], 'style' => 'color: green'];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="ups-manufacturers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
