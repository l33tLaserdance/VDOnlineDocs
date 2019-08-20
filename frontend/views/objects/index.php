<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use frontend\models\Objects;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ObjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объекты';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objects-index">

    <h1><?= Html::encode($this->title) ?> организации <?= $_GET['org_full_name'] ?></h1>

    <p>
        <?= Html::a('Добавить объект', ['create', 'id' => $_GET['id'], 'org_full_name' => $_GET['org_full_name'] ], ['class' => 'btn btn-success']) ?>   - причислить к данной организации новый объект
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<?php
	$gridColumns = [
		'№',
		'address',
		'obj_name',
		'Comment',
	];
	echo ExportMenu::widget([
		'dataProvider' => $dataProvider,
		'columns' => $gridColumns,
	]);
	?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'obj_table',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'obj_id','format'=>['integer'], 'hAlign'=>'center', 'width'=>'10px'],
            //['attribute'=>'org_id','format'=>['integer'], 'hAlign'=>'center', 'width'=>'10px'],
            ['attribute'=>'address','format'=>['text'], 'hAlign'=>'center', 'width'=>'300px'],
            ['attribute'=>'obj_name','format'=>['text'], 'hAlign'=>'center', 'width'=>'300px'],
            ['attribute'=>'Comment','format'=>['ntext'], 'hAlign'=>'center'],

            ['class' => 'yii\grid\ActionColumn',
				'urlCreator' => function($action, $model, $key, $index) {
					return [$action, 'id' => $model['obj_id'], 'org' => $_GET['org_full_name']];
				},
			],
		]
	]); ?>


</div>
