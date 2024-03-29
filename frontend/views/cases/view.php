<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use frontend\models\DeviceTypes;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cases */

$this->title = 'Просмотр шкафа №'.$model->case_num;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Шкафы', 'url' => ['index', 'id' => $_SESSION['obj_id'], 'obj_name' => $_SESSION['obj_name']]];
$this->params['breadcrumbs'][] = 'Просмотр шкафа';
\yii\web\YiiAsset::register($this);
?>
<div class="cases-view">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="row">
	<div class="col-lg-5">
	
		<p>
			<?= Html::a('Редактировать', ['update', 'id' => $model->case_id], ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px;']) ?>
		</p>
	
		<?= DetailView::widget([
			'model' => $model,
			'condensed' => true,
			'striped' => true,
			'hover' => true,
			'mode' => DetailView::MODE_VIEW,
			'enableEditMode' => false,
			'panel' => [
				'heading' => 'Информация о шкафе:',
				'type' => DetailView::TYPE_SUCCESS,
			],
			'formatter' => [
				'class' => 'yii\i18n\Formatter',
				'nullDisplay' => ''
			],
			'attributes' => [
				[
					'attribute' => 'case_num',
					'label' => '№ Шкафа:',
					'displayOnly' => true,
					'valueColOptions' => ['style' => 'width: 30%']
				],
				[
					'attribute' => 'build_num',
					'label' => '№ Стр.:',
					'displayOnly' => true,
					'valueColOptions' => ['style' => 'width: 30%']
				],
				[
					'attribute' => 'comm_name',
					'label' => 'Альт. название (по коммутатору):',
					'displayOnly' => true,
					'valueColOptions' => ['style' => 'width: 30%']
				],
				[
					'attribute' => 'case_name',
					'label' => 'Назв. шкафа (шифр с привязкой к стр. и этажу:',
					'displayOnly' => true,
					'valueColOptions' => ['style' => 'width: 30%']
				],
				[
					'attribute' => 'switch_ip',
					'label' => 'IP:',
					'displayOnly' => true,
					'valueColOptions' => ['style' => 'width: 30%']
				],
				[
					'attribute' => 'placement',
					'label' => 'Расположение:',
					'displayOnly' => true,
					'valueColOptions' => ['style' => 'width: 30%']
				],
				[
					'attribute' => 'expulsion',
					'label' => 'Продувка:',
					'displayOnly' => true,
					'valueColOptions' => ['style' => 'width: 30%']
				],
				[
					'attribute' => 'links',
					'label' => 'Линки:',
					'displayOnly' => true,
					'valueColOptions' => ['style' => 'width: 30%']
				],
				[
					'attribute' => 'order',
					'label' => 'Порядок:',
					'displayOnly' => true,
					'format' => 'raw',
					'valueColOptions' => ['style' => 'width: 30%'],
					'value' => $model->order ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>',
				],
				/*[
					'attribute' => 'photo',
					'label' => 'Фотография:',
					'displayOnly' => true,
					'format' => 'html',
					'valueColOptions' => ['style' => 'width: 200px'],
					'value' => '<img src="'.$model->photo.'" style="width: 50%; height: 50%;">',
				],*/
			],
		]) ?>
		<label for="inputComment" class="control-label col-xs-2">Комментарий:</label>
		<input name="Comment" type="text" class="form-control" style="cursor: context-menu; background-color: white;" id="inputComment" value="<?= $model->Comment; ?>" placeholder="Комментариев пока нет." disabled>
	</div>
	<div class="col-lg-7">
	
	<div class="row">
	
		<div class="col-lg-4">
		<?= Html::a('Добавить устройство', ['devices/create', 'id' => $_SESSION['case'], 'case_num' => $model->case_num], ['class' => 'btn btn-success', 'style' => 'margin-top: 10px;']) ?>
		</div>

		<div class="col-lg-2">
		
		</div>

		<div class="col-lg-6">
			<?php echo $this->render('_search', ['model' => $searchModel, 'search' => $search]); ?>
		</div>
		
	</div>
	
	<?php
	echo ExportMenu::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'attribute' => 'deviceType.dt_name',
				'label' => 'Тип устройства',
			],
			[
				'attribute' => 'device_name',
				'label' => 'Наименование устройства',
			],
			[
				'attribute' => 'port',
				'label' => 'Количество портов',
			],
			[
				'attribute' => 'Comment',
				'label' => 'Комментарий',
			],
		]	
	]);
	?>
	
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		//'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'devices_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
		'columns' => [
			//['class' => 'yii\grid\SerialColumn'],

			//'device_id',
			//'case_id',
			['attribute'=>'device_type','format'=>['text'], 'value'=>'deviceType.dt_name', 'filter'=>ArrayHelper::map(DeviceTypes::find()->all(), 'dt_id', 'dt_name'),'hAlign'=>'center', 'width'=>'20%'],
			['attribute'=>'device_name','format'=>['text'], 'hAlign'=>'center', 'width'=>'20%'],
			['attribute'=>'device_link','format'=>['html'], 'hAlign'=>'center', 'width'=>'20%'],
			['attribute'=>'port','format'=>['text'], 'hAlign'=>'center', 'width'=>'5%'],
			['attribute'=>'Comment','format'=>['text'], 'hAlign'=>'center', 'width'=>'25%'],

			['class' => 'yii\grid\ActionColumn',
				'visibleButtons' => [
					'delete' => function ($model, $key, $index) {
						return $model->device_type == 1;
					}
				],
				'urlCreator' => function ($action, $model, $key, $index) {
					if ($action === 'view') {
						$url ='/devices/view?id='.$model->device_id;
						return $url;
					}

					if ($action === 'update') {
						$url ='/devices/update?id='.$model->device_id;
						return $url;
					}

					if ($action === 'delete') {
						$url ='/devices/delete?id='.$model->device_id.'&devicetype='.$model->device_type;
						return $url;
					}
				},
				'contentOptions' => ['style' => 'width: 10%;'],
			],
		],
		'options' => [
			'style' => 'word-warp: break-word; font-size: 12px; table-layout: fixed;'
		],
    ]); ?>
	</div>
	
	<div class="col-lg-7">
		<img src="<?= $model->photo; ?>" style="max-width: 100%; max-height: 100%;">
	</div>
</div>
</div>
