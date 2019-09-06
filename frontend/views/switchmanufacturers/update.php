<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwitchManufacturers */

$this->title = 'Редактирование производителя ' . $model->swman_name;
$this->params['breadcrumbs'][] = ['label' => 'Производители коммутаторов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->swman_name, 'url' => ['view', 'id' => $model->id_swman], 'style' => 'color: green'];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="switch-manufacturers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
