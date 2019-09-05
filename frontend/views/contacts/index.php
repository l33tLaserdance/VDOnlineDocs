<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use frontend\models\Organization;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
	
		<div class="col-lg-4">
			<?= Html::a('Добавить контакт', ['create'], ['class' => 'btn btn-success', 'style' => 'margin-top: 10px;']) ?>
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
				'attribute' => 'org.org_name',
				'label' => 'Организация',
			],
			[
				'attribute' => 'FIO',
				'label' => 'ФИО',
			],
			[
				'attribute' => 'Phone',
				'label' => 'Телефон',
			],
			[
				'attribute' => 'Email',
			],
			[
				'attribute' => 'Positon',
				'label' => 'Должность',
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
		'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'contacts_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'contact_id',
            ['attribute'=>'org_id','format'=>['text'], 'value'=>'org.org_name', 'filter'=>ArrayHelper::map(Organization::find()->all(), 'id', 'org_name'),'hAlign'=>'center', 'width'=>'15%'],
            ['attribute'=>'FIO','format'=>['text'], 'hAlign'=>'center', 'width'=>'15%', 'filter' => false],
            ['attribute'=>'Phone','format'=>['text'], 'hAlign'=>'center', 'width'=>'15%', 'filter' => false],
            ['attribute'=>'Email','format'=>['email'], 'hAlign'=>'center', 'width'=>'15%', 'filter' => false],
            ['attribute'=>'Positon','format'=>['text'], 'hAlign'=>'center', 'width'=>'15%', 'filter' => false],
            ['attribute'=>'Comment','format'=>['text'], 'hAlign'=>'center', 'width'=>'15%', 'filter' => false],

            ['class' => 'yii\grid\ActionColumn',
				'urlCreator' => function($action, $model, $key, $index) {
					return [$action, 'id' => $model->contact_id, 'org' => $model->org_id];
				},
				'contentOptions' => ['style' => 'width: 10%;'],
			],
        ],
    ]); ?>


</div>
