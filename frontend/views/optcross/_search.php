<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model frontend\models\OptcrossSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?= Html::beginForm(Url::current(), 'get') ?>

<div class="post-search">
    <input type="text" name="search" class="form-control" id="Search" placeholder="Поиск" value="<?=$search?>" style="margin-top: 10px; margin-bottom: 10px;">
</div>
<?= Html::endForm() ?>
