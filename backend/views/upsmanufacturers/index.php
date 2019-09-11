<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UpsmanufacturersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Производители ИБП';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ups-manufacturers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить производителя ИБП', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Работа с моделями ИБП', ['upsmodels/index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'upsman_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
		'rowOptions' => function($model, $key, $index, $column) {
			if ($model->id_man == 4) {
				return ['class' => 'danger'];
			}
		},
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_man',
            ['attribute'=>'upsman_name','format'=>['text'],'hAlign'=>'center'],

            ['class' => 'yii\grid\ActionColumn',
			'visibleButtons' => [
					'delete' => function ($model, $key, $index) {
						return $model->id_man != 4;
					},
					'update' => function ($model, $key, $index) {
						return $model->id_man != 4;
					},
				],
			],
        ],
    ]); ?>


</div>
