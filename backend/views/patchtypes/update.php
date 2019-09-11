<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PatchTypes */

$this->title = 'Редактирование типа патч-панели №' . $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Типы патч-панелей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'id' => $model->ptype_id], 'style' => 'color: green'];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="patch-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
