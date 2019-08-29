<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devices */

$this->title = 'Просмотр устройства "'.$model->device_name.'".';
$this->params['breadcrumbs'][] = ['label' => 'Организации', 'url' => ['/organization']];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['org_full_name'], 'url' => ['/organization/view', 'id' => $_SESSION['org_id']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Объекты', 'url' => ['/organization/objects', 'id' => $_SESSION['org_id'], 'org_full_name' => $_SESSION['org_full_name']]];
$this->params['breadcrumbs'][] = ['label' => $_SESSION['obj_name'], 'url' => ['/objects/view', 'id' => $_SESSION['obj_id'], 'org' => $_SESSION['org_full_name']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = ['label' => 'Шкафы', 'url' => ['cases/index', 'id' => $_SESSION['obj_id'], 'obj_name' => $_SESSION['obj_name']]];
$this->params['breadcrumbs'][] = ['label' => '№'.$_SESSION['case_num'], 'url' => ['cases/view', 'id' => $_SESSION['case']], 'style' => 'color: green;'];
$this->params['breadcrumbs'][] = $model->device_name;
\yii\web\YiiAsset::register($this);
?>
<div class="devices-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->device_id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->device_type == 1) { ?>
		<?= Html::a('Удалить', ['delete', 'id' => $model->device_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данное устройство?',
                'method' => 'post',
            ],
        ]) ?>
		<?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'device_id',
            //'case_id',
            [
				'attribute' => 'device_type',
				//'label' => 'Линки:',
				'displayOnly' => true,
				'valueColOptions' => ['style' => 'width: 200px'],
				'value' => function($model) {
					if ($model->device_type == 1) {
						return 'ИБП';
					}
					if ($model->device_type == 2) {
						return 'Коммутатор';
					}
					if ($model->device_type == 3) {
						return 'Патч-панель';
					}
					if ($model->device_type == 4) {
						return 'Оптический кросс';
					}
				}
			],
            'device_name',
            'device_link',
            'port',
            'Comment:ntext',
        ],
    ]) ?>

</div>
