<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Switchboard */

$this->title = 'Порт №'.$model->port;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Шкафы', 'url' => ['cases/index', 'id' => $_SESSION['obj_id'], 'obj_name' => $_SESSION['obj_name']]];
$this->params['breadcrumbs'][] = ['label' => '№'.$_SESSION['case_num'], 'url' => ['cases/view', 'id' => $_SESSION['case']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Коммутатор "'.$_SESSION['switch_name'].'"', 'url' => ['switchboard/index', 'id' => $_SESSION['switch_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = 'Порт №'.$model->port;
\yii\web\YiiAsset::register($this);
?>

<div class="switchboard-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактирование', ['update', 'id' => $model->switch_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
		'condensed' => true,
		'striped' => true,
		'hover' => true,
		'mode' => DetailView::MODE_VIEW,
		'enableEditMode' => false,
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
		'panel' => [
			'heading' => 'Информация о порте:',
			'type' => DetailView::TYPE_SUCCESS,
		],
        'attributes' => [
            //'switch_id',
            //'device_id',
            //'switch_name',
            //'switch_model',
            //'switch_ip',
            'port',
            'connected_to',
            'model_connected_to',
            'ip_connected_to',
            'Comment:ntext',
			[
					'attribute' => 'functional',
					'label' => 'Функционирует:',
					'displayOnly' => true,
					'format' => 'raw',
					'valueColOptions' => ['style' => 'width: 200px'],
					'value' => $model->functional ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>',
			],
        ],
		'options' => [
			'style' => 'word-warp: break-word; font-size: 12px;'
		],
    ]) ?>

</div>
