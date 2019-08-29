<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UpsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ups-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ups', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ups_id',
            'device_id',
            'ups_model',
            'max_time',
            'battery_exchange',
            //'Comment:ntext',
            //'upscol',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
