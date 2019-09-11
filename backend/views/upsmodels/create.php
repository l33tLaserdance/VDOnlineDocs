<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UpsModels */

$this->title = 'Добавление модели ИБП';
$this->params['breadcrumbs'][] = ['label' => 'Список моделей ИБП', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ups-models-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
