<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PatchPanel */

$this->title = 'Порт №'.$model->ports;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Шкафы', 'url' => ['cases/index', 'id' => $_SESSION['obj_id'], 'obj_name' => $_SESSION['obj_name']]];
$this->params['breadcrumbs'][] = ['label' => '№'.$_SESSION['case_num'], 'url' => ['cases/view', 'id' => $_SESSION['case']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Патч-панель "'.$_SESSION['patch_name'].'"', 'url' => ['patchpanel/index', 'id' => $_SESSION['patch_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = 'Порт №'.$model->ports;
\yii\web\YiiAsset::register($this);
?>
<div class="patch-panel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактирование', ['update', 'id' => $model->patch_id], ['class' => 'btn btn-primary']) ?>
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
            //'patch_id',
            //'device_id',
            //'patch_name',
			'ports',
            'model',
            'ip',
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
    ]) ?>

</div>
