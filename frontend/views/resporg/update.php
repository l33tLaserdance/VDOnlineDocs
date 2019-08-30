<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RespOrg */

$this->title = 'Редактирование назначений';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Назначение ответственных', 'url' => ['resporg/index']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр назначения', 'url' => ['resporg/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование назначений';
?>
<div class="resp-org-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
