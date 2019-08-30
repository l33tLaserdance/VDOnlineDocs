<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use frontend\models\Organization;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contacts */

$this->title = 'Просмотр контакта: '.$model->FIO;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['contacts/index']];
$this->params['breadcrumbs'][] = ['label' => $model->FIO];
\yii\web\YiiAsset::register($this);
?>
<div class="contacts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактирование', ['update', 'id' => $model->contact_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаление', ['delete', 'id' => $model->contact_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот контакт?',
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
            //'contact_id',
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
			],
            [
				'attribute' => 'FIO',
				'label' => 'ФИО:',
				'displayOnly' => true,
			],
            [
				'attribute' => 'Phone',
				'label' => 'Телефон:',
				'displayOnly' => true,
			],
            [
				'attribute' => 'Email',
				'label' => 'Email:',
				'format' => 'email',
				'displayOnly' => true,
			],
            [
				'attribute' => 'Positon',
				'label' => 'Должность:',
				'displayOnly' => true,
			],
            [
				'attribute' => 'Comment',
				'label' => 'Комментарий:',
				'format' => 'text',
				'displayOnly' => true,
			],
        ],
    ]) ?>

</div>
