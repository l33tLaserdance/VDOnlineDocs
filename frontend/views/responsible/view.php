<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Responsible */

$this->title = $model->resp_FIO;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Назначение ответственных', 'url' => ['resporg/index']];
$this->params['breadcrumbs'][] = ['label' => 'Список сотрудников', 'url' => ['responsible/index']];
$this->params['breadcrumbs'][] = $model->resp_FIO;
\yii\web\YiiAsset::register($this);
?>
<div class="responsible-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактирование', ['update', 'id' => $model->resp_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаление', ['delete', 'id' => $model->resp_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данного сотрудника?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
		'condensed' => true,
		'striped' => true,
		'hover' => true,
		'mode' => DetailView::MODE_VIEW,
		'enableEditMode' => false,
		'panel' => [
			'heading' => 'Контактная информация:',
			'type' => DetailView::TYPE_SUCCESS,
		],
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
        'attributes' => [
            [
				'attribute' => 'resp_FIO',
				'label' => 'ФИО:',
				'displayOnly' => true,
			],
            [
				'attribute' => 'resp_phone',
				'label' => 'Контактный телефон:',
				'displayOnly' => true,
			],
            [
				'attribute' => 'resp_email',
				'label' => 'Email:',
				'format' => 'email',
				'displayOnly' => true,
			],
        ],
    ]) ?>

</div>
