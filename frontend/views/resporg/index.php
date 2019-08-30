<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use frontend\models\Organization;
use frontend\models\Responsible;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ResporgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Назначение ответственных';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resp-org-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назначить ответственных', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Таблица ответственных', ['responsible/index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<?php
	echo ExportMenu::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			[
				'attribute' => 'org.org_full_name',
				'label' => 'Организация',
			],
			[
				'attribute' => 'org.org_address',
				'label' => 'Адрес организации',
			],
			[
				'attribute' => 'resp.resp_FIO',
				'label' => 'ФИО ответственного',
			],
			[
				'attribute' => 'resp.resp_phone',
				'label' => 'Контактный телефон',
			],
			[
				'attribute' => 'resp.resp_email',
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

            //'id',
            ['attribute'=>'org_id','format'=>['text'], 'value'=>'org.org_full_name', 'filter'=>ArrayHelper::map(Organization::find()->all(), 'id', 'org_full_name'),'hAlign'=>'center', 'width'=>'45%'],
            ['attribute'=>'resp_id','format'=>['text'], 'value'=>'resp.resp_FIO', 'filter'=>ArrayHelper::map(Responsible::find()->all(), 'resp_id', 'resp_FIO'),'hAlign'=>'center', 'width'=>'45%'],

            ['class' => 'yii\grid\ActionColumn',
				'urlCreator' => function($action, $model, $key, $index) {
					return [$action, 'id' => $model->id, 'org' => $model->org_id, 'resp' => $model->resp_id];
				},
				'contentOptions' => ['style' => 'width: 10%;'],
			],
        ],
    ]); ?>


</div>
