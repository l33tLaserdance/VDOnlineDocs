<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SwitchmanufacturersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Производители коммутаторов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="switch-manufacturers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить производителя', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Работа с моделями коммутаторов', ['switchmodels/index'], ['class' => 'btn btn-warning']) ?>
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
			if ($model->id_swman == 9) {
				return ['class' => 'danger'];
			}
		},
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id_swman',
            ['attribute'=>'swman_name','format'=>['text'],'hAlign'=>'center'],

            ['class' => 'yii\grid\ActionColumn',
			'visibleButtons' => [
					'delete' => function ($model, $key, $index) {
						return $model->id_swman != 9;
					},
					'update' => function ($model, $key, $index) {
						return $model->id_swman != 9;
					},
				],
			],
        ],
    ]); ?>


</div>
