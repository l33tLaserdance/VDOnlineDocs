<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use frontend\models\UpsManufacturers;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UpsmodelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список моделей ИБП';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ups-models-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Работа с производителями ИБП', ['upsmanufacturers/index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'upsmod_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
		'rowOptions' => function($model, $key, $index, $column) {
			if ($model->id_upsmod == 5) {
				return ['class' => 'danger'];
			}
		},
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_upsmod',
			['attribute'=>'manufacturer','format'=>['text'], 'value'=>'manufacturer0.upsman_name', 'filter'=>ArrayHelper::map(UpsManufacturers::find()->all(), 'id_man', 'upsman_name'),'hAlign'=>'center', 'width'=>'45%'],
            'model',

            ['class' => 'yii\grid\ActionColumn',
			'visibleButtons' => [
					'delete' => function ($model, $key, $index) {
						return $model->id_upsmod != 5;
					},
					'update' => function ($model, $key, $index) {
						return $model->id_upsmod != 5;
					},
				],
			],
        ],
    ]); ?>


</div>
