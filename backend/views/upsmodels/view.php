<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsModels */

$this->title = $model->model;
$this->params['breadcrumbs'][] = ['label' => 'Список моделей ИБП', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ups-models-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?php if ($model->id_upsmod != 5) { ?>
        <?= Html::a('Редактирование', ['update', 'id' => $model->id_upsmod], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаление', ['delete', 'id' => $model->id_upsmod], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данную модель ИБП?',
                'method' => 'post',
            ],
        ]) ?>
		<?php } else { ?>
			<p class="lead">Данное поле нельзя удалить или отредактировать, оно необходимо для работы некоторых скриптов</p>
		<?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_upsmod',
            'manufacturer0.upsman_name',
            'model',
        ],
    ]) ?>

</div>
