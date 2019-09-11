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

if (!isset($_SESSION['org_full_name'])) {
	$_SESSION['org_full_name'] = $model->org_full_name;
}
?>
<div class="organization-view">
	
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактирование', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
    </p>
	
	<?php
	$gridfortable = [
		[
			'attribute'=>'FIO',
			'label' => 'ФИО',
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
		[
			'attribute'=>'Phone',
			'label' => 'Телефон',
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
		[
			'attribute'=>'Email',
			'label' => 'Email',
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
		[
			'attribute'=>'Positon',
			'label' => 'Должность',
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
	];
	?>
	
	<?php
	$gridfortable2 = [
		[
			'attribute'=>'resp_FIO',
			'label' => 'ФИО',
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
		[
			'attribute'=>'resp_phone',
			'label' => 'Контактный телефон',
			'hAlign'=>'middle',
			'vAlign'=>'middle',
			'width'=>'100px',
			'format'=>['text'],
			'pageSummary'=>true
		],
		[
			'attribute'=>'resp_email',
			'label' => 'Email',
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
		<p>
			<?= Html::a('Редактирование контактных лиц', ['contacts/index'/*, 'id' => $model->id]*/], ['class' => 'btn btn-success']) ?> <!-- расскоментить если надо передать id -->
		</p>
		
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
				'layout' => '{items}\n{pager}',
				'type' => GridView::TYPE_SUCCESS,
				'heading' => 'Контактные лица:',
				'footer' => false,
			],
		]); ?>
		
		<p>
			<?= Html::a('Редактирование ответственных лиц', ['resporg/index'/*, 'id' => $model->id]*/], ['class' => 'btn btn-success']) ?> <!-- расскоментить если надо передать id -->
		</p>
		
		<?= GridView::widget([
			'dataProvider' => $dataProvider2,
			//'filterModel' => $searchModel,
			'columns' => $gridfortable2,
			//'filterModel' => $searchModel,
			'pjax' => true,
			'headerRowOptions' => ['class' => 'kartik-sheet-style'],
			'filterRowOptions' => ['class' => 'kartik-sheet-style'],
			'bordered' => true,
			'toolbar' => false,
			'panel' => [
				'type' => GridView::TYPE_SUCCESS,
				'heading' => 'Ответственные лица:',
				'footer' => false,
			],
		]); ?>
		
		</div>
		<div class="col-lg-4">
			<img src="<?= $model->photo; ?>" style="max-width: 100%; max-height: 100%;">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<label for="inputComment" class="control-label col-xs-2">Комментарий:</label>
			<input name="Comment" type="text" class="form-control" style="cursor: context-menu; background-color: white;" id="inputComment" value="<?= $model->Comment; ?>" placeholder="Комментариев пока нет." disabled>
		</div>
	</div>
	</div>	
</div>
