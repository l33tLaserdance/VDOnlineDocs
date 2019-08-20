<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use frontend\models\Contacts;
use kartik\grid\EditableColumn;
use kartik\editable\Editable;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model frontend\models\Organization */

$this->title = $model->org_full_name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="organization-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактирование', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаление', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
	
	<?php // пока не используется
	$gridfortable = [
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'FIO',
			'editableOptions'=>[
				'header' => 'ФИО',
				//'name' => 'FIO',
				'formOptions'=>['action' => ['/organization/editfio']],
				'format' => \kartik\editable\Editable::FORMAT_BUTTON,
				'inputType' => \kartik\editable\Editable::INPUT_TEXT,
				//'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]]
			],
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'Phone',
			'editableOptions'=>[
				'header' => 'телефон',
				//'name' => 'Phone',
				'formOptions'=>['action' => ['/organization/editfio']],
				'format' => \kartik\editable\Editable::FORMAT_BUTTON,
				'inputType' => \kartik\editable\Editable::INPUT_TEXT,
				//'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]]
			],
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'Email',
			'editableOptions'=>[
				'header' => 'email',
				//'name' => 'Email',
				'formOptions'=>['action' => ['/organization/editfio']],
				'format' => \kartik\editable\Editable::FORMAT_BUTTON,
				'inputType' => \kartik\editable\Editable::INPUT_TEXT,
				//'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]]
			],
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'Positon',
			'editableOptions'=>[
				'header' => 'должность',
				//'name' => 'Positon',
				'formOptions'=>['action' => ['/organization/editfio']],
				'format' => \kartik\editable\Editable::FORMAT_BUTTON,
				'inputType' => \kartik\editable\Editable::INPUT_TEXT,
				//'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]]
			],
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
	];
	?>

    <?= DetailView::widget([
        'model' => $model,
		'condensed' => true,
		'striped' => true,
		'hover' => true,
		'mode' => DetailView::MODE_VIEW,
		'enableEditMode' => false,
		'panel' => [
			'heading' => 'Общая информация по организации:',
			'type' => DetailView::TYPE_SUCCESS,
		],
        'attributes' => [
			[
				'columns' => [
					[
						'attribute' => 'org_name',
						'label' => 'Наименование организации:',
						'displayOnly' => true,
						'valueColOptions' => ['style' => 'width: 200px']
					],
					[
						'attribute' => 'org_full_name',
						'label' => 'Полное наименование организации:',
						'displayOnly' => true,
						'valueColOptions' => ['style' => 'width: 200px']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute' => 'INN',
						'label' => 'ИНН:',
						'displayOnly' => true,
						'valueColOptions' => ['style' => 'width: 200px']
					],
					[
						'attribute' => 'org_address',
						'label' => 'Адрес организации:',
						'displayOnly' => true,
						'valueColOptions' => ['style' => 'width: 200px']
					],
				],
			],
            //'id',
            //'Comment:ntext',
        ],
    ]) ?>
	<div class="row">
		<div class="col-lg-8">
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			//'filterModel' => $searchModel,
			'columns' => $gridfortable,
			//'filterModel' => $searchModel,
			'pjax' => true,
			'headerRowOptions' => ['class' => 'kartik-sheet-style'],
			'filterRowOptions' => ['class' => 'kartik-sheet-style'],
			'bordered' => true,
			'toolbar' => false,
			'panel' => [
				'type' => GridView::TYPE_SUCCESS,
				'heading' => 'Контактные лица:',
				'footer' => false,
			],
		]); ?>
		</div>
	</div>
</div>
