<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Patches */

$this->title = 'Добавление патч-панели';
$this->params['breadcrumbs'][] = ['label' => 'Патч-панели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patches-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
