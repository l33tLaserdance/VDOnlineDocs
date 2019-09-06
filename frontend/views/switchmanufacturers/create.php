<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwitchManufacturers */

$this->title = 'Добавление производителя';
$this->params['breadcrumbs'][] = ['label' => 'Производители коммутаторов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="switch-manufacturers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
