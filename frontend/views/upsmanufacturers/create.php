<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsManufacturers */

$this->title = 'Добавление производителя';
$this->params['breadcrumbs'][] = ['label' => 'Производители ИБП', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ups-manufacturers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
