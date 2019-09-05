<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PatchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Патч-панели';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patches-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить патч-панель', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax' => true,
		'id' => 'patches_table',
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_patches',
            'patches_type',
            'ports',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
