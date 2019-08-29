<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ups */

$this->title = 'Просмотр ИБП "'.$_SESSION['ups_name'].'".';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Шкафы', 'url' => ['cases/index', 'id' => $_SESSION['obj_id'], 'obj_name' => $_SESSION['obj_name']]];
$this->params['breadcrumbs'][] = ['label' => '№'.$_SESSION['case_num'], 'url' => ['cases/view', 'id' => $_SESSION['case']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = $_SESSION['ups_name'];
\yii\web\YiiAsset::register($this);
?>
<div class="ups-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->ups_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
		'condensed' => true,
		'striped' => true,
		'hover' => true,
		'mode' => DetailView::MODE_VIEW,
		'enableEditMode' => false,
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => ''
		],
		'panel' => [
			'heading' => 'Информация о ИБП:',
			'type' => DetailView::TYPE_SUCCESS,
		],
        'attributes' => [
            //'ups_id',
            //'device_id',
            'ups_model',
            'max_time',
            'battery_exchange',
            //'Comment:ntext',
            'upscol',
        ],
    ]) ?>
	
	<label for="inputComment" class="control-label col-xs-2">Комментарий:</label>
		<input name="Comment" type="text" class="form-control" style="cursor: context-menu; background-color: white;" id="inputComment" value="<?= $model->Comment; ?>" placeholder="Комментариев пока нет." disabled>

</div>
