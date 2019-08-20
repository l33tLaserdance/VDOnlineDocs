<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Objects */

$this->title = 'Просмотр объекта: ' . $model->obj_name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $model->org_id]];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['index', 'id' => $model->org_id, 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = 'Просмотр объекта';
\yii\web\YiiAsset::register($this);
?>
<div class="objects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->obj_id, 'org' => $_SESSION['org_full_name']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->obj_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данную запись??',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'obj_id',
            //'org_id',
            'address',
            'obj_name',
            'Comment:ntext',
        ],
    ]) ?>

</div>
