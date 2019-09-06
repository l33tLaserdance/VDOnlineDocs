<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwitchModels */

$this->title = 'Добавление модели коммутатора';
$this->params['breadcrumbs'][] = ['label' => 'Модели коммутаторов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="switch-models-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
