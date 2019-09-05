<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrgnizationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Организации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
	
		<div class="col-lg-4">
			<?= Html::a('Добавить организацию', ['create'], ['class' => 'btn btn-success', 'style' => 'margin-top: 10px;']) ?> 
		</div>

		<div class="col-lg-2">

		</div>

		<div class="col-lg-6">
			<?php echo $this->render('_search', ['model' => $searchModel, 'search' => $search]); ?>
		</div>
		
	</div>
	
	<?php
	$gridColumns = [
		'id',
		'org_name',
		'org_full_name',
		'INN',
		'org_address',
		'Comment'
	];
	echo ExportMenu::widget([
		'dataProvider' => $dataProvider,
		'columns' => $gridColumns,
	]);
	?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'org_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //['attribute'=>'id','format'=>['integer'], 'hAlign'=>'center', 'width'=>'10px'],
            ['attribute'=>'org_name','format'=>['text'], 'hAlign'=>'center', 'width'=>'200px'],
            ['attribute'=>'org_full_name',
			'value' => function($data) {
				return HTML::a(Html::encode($data->org_full_name), Url::to(['objects', 'id' => $data->id, 'org_full_name' => $data->org_full_name]));
			},
			'format'=>['html'], 'hAlign'=>'center', 'width'=>'200px'],
            ['attribute'=>'INN','format'=>['text'], 'hAlign'=>'center', 'width'=>'100px'],
			['attribute'=>'org_address','format'=>['text'], 'hAlign'=>'center', 'width'=>'200px'],
            ['attribute'=>'Comment','format'=>['ntext'], 'hAlign'=>'center', 'width' => '330px'],

            ['class' => 'yii\grid\ActionColumn',
				'visibleButtons' => [
					'delete' => false,
				],
			],
        ],
		'options' => [
			'style' => 'word-warp: break-word;'
		],
    ]); ?>

</div>
