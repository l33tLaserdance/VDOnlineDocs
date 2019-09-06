<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use frontend\models\SwitchManufacturers;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SwitchmodelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Модели коммутаторов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="switch-models-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новую модель', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Работа с производителями коммутаторов', ['switchmanufacturers/index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'swmod_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
		'rowOptions' => function($model, $key, $index, $column) {
			if ($model->id_switchmod == 2) {
				return ['class' => 'danger'];
			}
		},
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_switchmod',
			['attribute'=>'manufacturer','format'=>['text'], 'value'=>'manufacturer0.swman_name', 'filter'=>ArrayHelper::map(SwitchManufacturers::find()->all(), 'id_swman', 'swman_name'),'hAlign'=>'center', 'width'=>'45%'],
            'model',
            'ports',
            ['class' => 'kartik\grid\BooleanColumn', 'trueLabel' => 'Да', 'falseLabel' => 'Нет', 'attribute' => 'PoE', 'hAlign'=>'center'],

            ['class' => 'yii\grid\ActionColumn',
			'visibleButtons' => [
					'delete' => function ($model, $key, $index) {
						return $model->id_switchmod != 2;
					},
					'update' => function ($model, $key, $index) {
						return $model->id_switchmod != 2;
					},
				],
			],
        ],
    ]); ?>


</div>
