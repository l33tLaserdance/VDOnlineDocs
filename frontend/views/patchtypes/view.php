<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\PatchTypes */

$this->title = $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Типы патч-панелей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="patch-types-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?php if ($model->ptype_id != 5) { ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->ptype_id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Удалить', ['delete', 'id' => $model->ptype_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить эту запись?',
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
            'ptype_id',
            'type',
        ],
    ]) ?>

</div>
