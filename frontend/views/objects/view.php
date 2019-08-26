<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Objects */

$this->title = 'Просмотр объекта: ' . $model->obj_name;
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $model->org_id], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['index', 'id' => $model->org_id, 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = 'Просмотр объекта';
\yii\web\YiiAsset::register($this);
?>
<div class="objects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактирование', ['update', 'id' => $model->obj_id, 'org' => $_SESSION['org_full_name']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаление', ['delete', 'id' => $model->obj_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данную запись??',
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
			'heading' => 'Информация об объекте:',
			'type' => DetailView::TYPE_SUCCESS,
		],
        'attributes' => [
            [
				'columns' => [
					[
						'attribute' => 'address',
						'label' => 'Адрес:',
						'displayOnly' => true,
						'valueColOptions' => ['style' => 'width: 200px']
					],
					[
						'attribute' => 'obj_name',
						'label' => 'Название объекта:',
						'displayOnly' => true,
						'valueColOptions' => ['style' => 'width: 200px']
					],
				],
			],
        ],
    ]) ?>
	<div class="row">
		<div class="col-lg-6">
			<img src="<?= $model->photo; ?>" style="max-width: 100%; max-height: 100%;">
		</div>
		<div class="col-lg-6">
			<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%<?= $model->map; ?>&amp;width=555&amp;height=555&amp;lang=ru_RU&amp;scroll=true"></script>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-12">
			<label for="inputComment" class="control-label col-xs-2">Комментарий:</label>
			<input name="Comment" type="text" class="form-control" style="cursor: context-menu; background-color: white;" id="inputComment" value="<?= $model->Comment; ?>" placeholder="Комментариев пока нет." disabled>
		</div>
	</div>

</div>
