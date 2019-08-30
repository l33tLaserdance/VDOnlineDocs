<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use frontend\models\Organization;
use frontend\models\Responsible;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\RespOrg */

$this->title = 'Просмотр назначения';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Назначение ответственных', 'url' => ['resporg/index']];
$this->params['breadcrumbs'][] = 'Просмотр назначения';
\yii\web\YiiAsset::register($this);
?>
<div class="resp-org-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактирование', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаление', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данное назначение?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
		'condensed' => true,
		'striped' => true,
		'hover' => true,
		'mode' => DetailView::MODE_VIEW,
		'enableEditMode' => false,
		'panel' => [
			'heading' => 'Контактная информация:',
			'type' => DetailView::TYPE_SUCCESS,
		],
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
        'attributes' => [
            //'id',
            [
				'attribute' => 'org_id',
				'label' => 'Организация:',
				'displayOnly' => true,
				'value' => function($model) {
					$orgfull = (new Query())
						->select('org_full_name')
						->from('organization')
						->where(['id' => $_GET['org']])
						->all();
						
					return $orgfull[0]['org_full_name'];
				},
				'valueColOptions' => ['style' => 'width: 30%'],
			],
            [
				'attribute' => 'resp_id',
				'label' => 'Ответственный:',
				'displayOnly' => true,
				'value' => function($model) {
					$resp = (new Query())
						->select('resp_FIO')
						->from('responsible')
						->where(['resp_id' => $_GET['resp']])
						->all();
						
					return $resp[0]['resp_FIO'];
				},
				'valueColOptions' => ['style' => 'width: 30%'],
			],
        ],
    ]) ?>

</div>
