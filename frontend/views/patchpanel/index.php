<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PatchpanelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Патч-панель "'.$_SESSION['patch_name'].'"';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Шкафы', 'url' => ['cases/index', 'id' => $_SESSION['obj_id'], 'obj_name' => $_SESSION['obj_name']]];
$this->params['breadcrumbs'][] = ['label' => '№'.$_SESSION['case_num'], 'url' => ['cases/view', 'id' => $_SESSION['case']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patch-panel-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<h2><?= 'Шкаф №'.$_SESSION['case_num'] ?></h2>

	<div class="row">
	
		<div class="col-lg-4">
			<?= Html::a('Удаление патч-панели', ['delete', 'id' => $_GET['id']], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Вы уверены что хотите удалить данную патч-панель? Все данные будут потеряны безвозвратно и возможно в дальнейшем потребуется заполнять их заново.',
					'method' => 'post',
				],
				 'style' => 'margin-top: 10px;',
			]) ?>
		</div>

		<div class="col-lg-2">
		
		</div>

		<div class="col-lg-6">
			<?php echo $this->render('_search', ['model' => $searchModel, 'search' => $search]); ?>
		</div>
		
	</div

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<?php
	echo ExportMenu::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'attribute' => 'ports',
				'label' => 'Порт',
				'hAlign' => GridView::ALIGN_CENTER,
			],
			[
				'attribute' => 'model',
				'label' => 'Устройство',
				'hAlign' => GridView::ALIGN_CENTER,
			],
			[
				'attribute' => 'ip',
				'label' => 'IP-адрес',
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
		'id' => 'patch_table',
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

            //'patch_id',
            //'device_id',
            //'patch_name',
			['attribute'=>'ports','format'=>['raw'], 'hAlign'=>'center', 'width'=>'50px'],
            ['attribute'=>'model','format'=>['text'], 'hAlign'=>'center', 'width'=>'300px'],
            ['attribute'=>'ip','format'=>['text'], 'hAlign'=>'center', 'width'=>'300px'],
            ['attribute'=>'Comment','format'=>['text'], 'hAlign'=>'left', 'width'=>'440px'],

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
