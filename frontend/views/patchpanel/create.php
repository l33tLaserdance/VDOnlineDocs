<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PatchPanel */

$this->title = 'Create Patch Panel';
$this->params['breadcrumbs'][] = ['label' => 'Patch Panels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patch-panel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
