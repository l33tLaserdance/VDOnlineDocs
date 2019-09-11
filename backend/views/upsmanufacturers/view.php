<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsManufacturers */

$this->title = $model->upsman_name;
$this->params['breadcrumbs'][] = ['label' => 'Производители ИБП', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ups-manufacturers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?php if ($model->id_man != 4) { ?>
        <?= Html::a('Редактирование', ['update', 'id' => $model->id_man], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаление', ['delete', 'id' => $model->id_man], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данного производителя?',
                'method' => 'post',
            ],
        ]) ?>
		<?php } else { ?>
			<p class="lead">Данное поле нельзя удалить или отредактировать, оно необходимо для работы некоторых скриптов</p>
		<?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_man',
            'upsman_name',
        ],
    ]) ?>

</div>
