<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwitchModels */

$this->title = $model->model;
$this->params['breadcrumbs'][] = ['label' => 'Модели коммутаторов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="switch-models-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?php if ($model->id_switchmod != 2) { ?>
        <?= Html::a('Редактирование', ['update', 'id' => $model->id_switchmod], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаление', ['delete', 'id' => $model->id_switchmod], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данную модель коммутатора?',
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
            [
				'attribute' => 'id_switchmod',
				'label' => 'ID:',
				'displayOnly' => true,
				'valueColOptions' => ['style' => 'width: 30%']
			],
            'manufacturer0.swman_name',
            'model',
            'ports',
            [
				'attribute' => 'PoE',
				'label' => 'PoE:',
				'displayOnly' => true,
				'format' => 'raw',
				'valueColOptions' => ['style' => 'width: 30%'],
				'value' => $model->PoE ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>',
			],
        ],
    ]) ?>

</div>
