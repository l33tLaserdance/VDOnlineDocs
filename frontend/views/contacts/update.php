<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */

$this->title = 'Редактирование контакта: '.$model->FIO;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['contacts/index']];
$this->params['breadcrumbs'][] = ['label' => $model->FIO, 'url' => ['contacts/view', 'id' => $_SESSION['org_id'], 'org' => $model->org_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="contacts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
