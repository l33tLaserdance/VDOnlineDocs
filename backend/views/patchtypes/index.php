<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PatchtypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы патч-панелей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patch-types-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новый тип', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'pptypes_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
		'rowOptions' => function($model, $key, $index, $column) {
			if ($model->ptype_id == 5) {
				return ['class' => 'danger'];
			}
		},
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'ptype_id',
            ['attribute'=>'type','format'=>['text'],'hAlign'=>'center'],

            ['class' => 'yii\grid\ActionColumn',
			'visibleButtons' => [
					'delete' => function ($model, $key, $index) {
						return $model->ptype_id != 5;
					},
					'update' => function ($model, $key, $index) {
						return $model->ptype_id != 5;
					},
				],
			],
        ],
    ]); ?>


</div>
