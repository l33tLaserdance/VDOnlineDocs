<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OptcrossSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оптический кросс "'.$_SESSION['optcross_name'].'"';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Шкафы', 'url' => ['cases/index', 'id' => $_SESSION['obj_id'], 'obj_name' => $_SESSION['obj_name']]];
$this->params['breadcrumbs'][] = ['label' => '№'.$_SESSION['case_num'], 'url' => ['cases/view', 'id' => $_SESSION['case']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="optcross-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<h2><?= 'Шкаф №'.$_SESSION['case_num'] ?></h2>
	
	<div class="row">
	
		<div class="col-lg-4">
			<?= Html::a('Удаление оптического кросса', ['delete', 'id' => $_GET['id']], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => 'Вы уверены что хотите удалить данный кросс? Все данные будут потеряны безвозвратно и возможно в дальнейшем потребуется заполнять их заново.',
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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
				'attribute' => 'uplink',
				'label' => 'Uplink',
				'hAlign' => GridView::ALIGN_CENTER,
			],
			[
				'attribute' => 'connected_to',
				'label' => 'Куда подключен',
				'hAlign' => GridView::ALIGN_CENTER,
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
		'id' => 'opt_table',
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

            //'optcross_id',
            //'device_id',
            //'optcross_name',
            ['attribute'=>'port','format'=>['raw'], 'hAlign'=>'center', 'width'=>'50px'],
            ['attribute'=>'uplink','format'=>['text'], 'hAlign'=>'center', 'width'=>'300px'],
            ['attribute'=>'connected_to','format'=>['text'], 'hAlign'=>'center', 'width'=>'300px'],
            ['attribute'=>'Comment', 'format'=>['text'], 'hAlign'=>'left', 'width'=>'300px'],
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
