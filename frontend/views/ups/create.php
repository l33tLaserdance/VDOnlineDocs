<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Ups */

$this->title = 'Create Ups';
$this->params['breadcrumbs'][] = ['label' => 'Ups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
