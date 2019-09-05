<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PatchTypes */

$this->title = 'Добавление нового типа патч-панели';
$this->params['breadcrumbs'][] = ['label' => 'Типы патч-панелей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patch-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
