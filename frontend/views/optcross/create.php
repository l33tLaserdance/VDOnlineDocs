<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Optcross */

$this->title = 'Create Optcross';
$this->params['breadcrumbs'][] = ['label' => 'Optcrosses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="optcross-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
