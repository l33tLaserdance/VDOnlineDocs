<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SwitchboardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Коммутатор "'.$_SESSION['switch_name'].'"';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Шкафы', 'url' => ['cases/index', 'id' => $_SESSION['obj_id'], 'obj_name' => $_SESSION['obj_name']]];
$this->params['breadcrumbs'][] = ['label' => '№'.$_SESSION['case_num'], 'url' => ['cases/view', 'id' => $_SESSION['case']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="switchboard-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<h2><?php echo 'Наименование: '.$_SESSION['name'].', IP-адрес: '.$_SESSION['ip'];
		if ($control == 0) {
			echo ' <span class="label label-danger">Неуправляемый</span>';
		}
		if ($control == 1) {
			echo ' <span class="label label-success">Управляемый</span>';
		}
		if ($poe == 0) {
			echo ' <span class="label label-danger">без PoE</span>';
		}
		if ($poe == 1) {
			echo ' <span class="label label-success">с PoE</span>';
		}
	?></h2>
	
    <div class="row">
	
		<div class="col-lg-4">
			<?= Html::a('Удаление коммутатора', ['delete', 'id' => $_GET['id']], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Вы уверены что хотите удалить данный коммутатор? Все данные будут потеряны безвозвратно и возможно в дальнейшем потребуется заполнять их заново.',
					'method' => 'post',
				],
				'style' => 'margin-top: 10px;'
			]) ?>
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
				'attribute' => 'port',
				'label' => 'Порт',
				'hAlign' => GridView::ALIGN_CENTER,
			],
			[
				'attribute' => 'connected_to',
				'label' => 'Куда подключён',
				'hAlign' => GridView::ALIGN_CENTER,
			],
			[
				'attribute' => 'model_connected_to',
				'label' => 'Модель подключенного устройства',
			],
			[
				'attribute' => 'ip_connected_to',
				'label' => 'IP подключения',
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
		'id' => 'switchboard_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
		'rowOptions' => function($model, $key, $index, $column) {
			if ($model->functional == 0) {
				return ['class' => 'danger'];
			}
		},
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'switch_id',
            //'device_id',
            //'switch_name',
            //'switch_model',
            //'switch_ip',
            ['attribute'=>'port','format'=>['raw'], 'hAlign'=>'center', 'width'=>'5%'],
            ['attribute'=>'connected_to','format'=>['text'], 'hAlign'=>'center', 'width'=>'20%'],
            ['attribute'=>'model_connected_to','format'=>['text'], 'hAlign'=>'center', 'width'=>'20%'],
            ['attribute'=>'ip_connected_to','format'=>['text'], 'hAlign'=>'center', 'width'=>'10%'],
            ['attribute'=>'Comment',
			/*'contentOptions' => function ($model, $key, $index, $column) {
				return ['style' => 'background-color:' 
					. ($model->functional == 1 ? 'red' : 'white')];
			},*/ //иметь ввиду, что так можно менять цвет одной конкретной ячейки
			'format'=>['text'], 'hAlign'=>'left', 'width'=>'35%'],
			//['class' => 'kartik\grid\BooleanColumn', 'trueLabel' => 'Да', 'falseLabel' => 'Нет', 'attribute' => 'functional', 'hAlign'=>'center', 'width'=>'10px'],

            ['class' => 'yii\grid\ActionColumn',
				'visibleButtons' => [
					'delete' => false,
				],
			],
        ],
		'options' => [
			'style' => 'word-warp: break-word; font-size: 12px;'
		],
    ]); ?>


</div>
