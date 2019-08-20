<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Objects */

$this->title = 'Обновление объекта: ' . $model->obj_name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $model->org_id]];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['index', 'id' => $model->org_id, 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $model->obj_name, 'url' => ['view', 'id' => $model->obj_id]];
$this->params['breadcrumbs'][] = 'Обновление объекта';
?>
<div class="objects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
