<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ResponsibleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список сотрудников';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Назначение ответственных', 'url' => ['resporg/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responsible-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
	
		<div class="col-lg-4">
			<?= Html::a('Добавить сотрудника', ['create'], ['class' => 'btn btn-success', 'style' => 'margin-top: 10px;']) ?>
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
				'attribute' => 'resp_FIO',
				'label' => 'ФИО ответственного',
			],
			[
				'attribute' => 'resp_phone',
				'label' => 'Контактный телефон',
			],
			[
				'attribute' => 'resp_email',
				'label' => 'Email',
			],
		]	
	]);
	?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		//'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'contacts_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'resp_id',
            ['attribute'=>'resp_FIO','format'=>['text'], 'hAlign'=>'center', 'width'=>'30%'],
            ['attribute'=>'resp_phone','format'=>['text'], 'hAlign'=>'center', 'width'=>'30%'],
            ['attribute'=>'resp_email','format'=>['email'], 'hAlign'=>'center', 'width'=>'30%'],

            ['class' => 'yii\grid\ActionColumn',
				'contentOptions' => ['style' => 'width: 10%;'],
			],
        ],
    ]); ?>


</div>
