<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CasesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Шкафы объекта "'.$_SESSION['obj_name'].'"';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cases-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить шкаф', ['create', 'id' => $_SESSION['obj_id'], 'obj_name' => $_GET['obj_name'] ], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php
	echo ExportMenu::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'attribute' => 'case_num',
				'label' => '№ Шкафа',
			],
			[
				'attribute' => 'build_num',
				'label' => '№ Стр.',
			],
			[
				'attribute' => 'comm_name',
				'label' => 'Альт. название (по коммутатору)',
			],
			[
				'attribute' => 'case_name',
				'label' => 'Назв. шкафа (шифр с привязкой к стр. и этажу)',
			],
			[
				'attribute' => 'switch_ip',
				'label' => 'IP',
			],
			[
				'attribute' => 'placement',
				'label' => 'Расположение',
			],
			[
				'attribute' => 'expulsion',
				'label' => 'Продувка',
			],
			[
				'attribute' => 'links',
				'label' => 'Линки',
			],
			[
				'attribute' => 'order',
				'label' => 'Порядок',
			],
			[
				'attribute' => 'photo',
				'label' => 'Фото',
			],
		]	
	]);
	?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'cases_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'case_id',
            //'obj_id',
            ['attribute'=>'case_num','format'=>['integer'], 'hAlign'=>'center', 'width'=>'60px'],
            ['attribute'=>'build_num','format'=>['text'], 'hAlign'=>'center', 'width'=>'60px'],
            ['attribute'=>'comm_name','format'=>['text'], 'hAlign'=>'center', 'width'=>'70px'],
            ['attribute'=>'case_name','format'=>['text'], 'hAlign'=>'center', 'width'=>'90px'],
            ['attribute'=>'switch_ip','format'=>['text'], 'hAlign'=>'center', 'width'=>'20px'],
            ['attribute'=>'placement','format'=>['text'], 'hAlign'=>'left', 'width'=>'420px'],
            ['attribute'=>'expulsion','format'=>['text'], 'hAlign'=>'left', 'width'=>'150px'],
            ['attribute'=>'links','format'=>['text'], 'hAlign'=>'left', 'width'=>'50px'],
            ['class' => 'kartik\grid\BooleanColumn', 'trueLabel' => 'Да', 'falseLabel' => 'Нет', 'attribute' => 'order', 'hAlign'=>'center', 'width'=>'10px'],
            //['attribute'=>'photo','format'=>['text'], 'hAlign'=>'left', 'width'=>'50px'],
            //'Comment:ntext',

            ['class' => 'yii\grid\ActionColumn',
				'urlCreator' => function($action, $model, $key, $index) {
					return [$action, 'id' => $model['case_id'], 'case' => $_GET['obj_name'], 'case_num' => $model['case_num']];
				},
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
