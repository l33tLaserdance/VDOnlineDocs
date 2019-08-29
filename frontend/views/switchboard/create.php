<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Switchboard */

$this->title = 'Create Switchboard';
$this->params['breadcrumbs'][] = ['label' => 'Switchboards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="switchboard-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
