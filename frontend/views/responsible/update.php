<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Responsible */

$this->title = 'Редактирование сотрудника: ' . $model->resp_FIO;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Назначение ответственных', 'url' => ['resporg/index']];
$this->params['breadcrumbs'][] = ['label' => 'Список сотрудников', 'url' => ['responsible/index']];
$this->params['breadcrumbs'][] = ['label' => $model->resp_FIO, 'url' => ['responsible/view', 'id' => $model->resp_id], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="responsible-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
