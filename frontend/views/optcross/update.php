<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Optcross */

$this->title = 'Редактирование порта №'.$model->port;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Шкафы', 'url' => ['cases/index', 'id' => $_SESSION['obj_id'], 'obj_name' => $_SESSION['obj_name']]];
$this->params['breadcrumbs'][] = ['label' => '№'.$_SESSION['case_num'], 'url' => ['cases/view', 'id' => $_SESSION['case']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Оптический кросс "'.$_SESSION['optcross_name'].'"', 'url' => ['optcross/index', 'id' => $_SESSION['optcross_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Порт №'.$model->port, 'url' => ['optcross/view', 'id' => $_GET['id']]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="optcross-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
