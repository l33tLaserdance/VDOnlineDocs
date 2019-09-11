<?php

/* @var $this yii\web\View */

$this->title = 'Onlinedocs Admin Panel';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Placeholder</h1>

        <p class="lead">Onlinedocs Admin Panel</p>
		
		<p class="lead">Ниже находятся формы, которым пока что не нашлось применения</p>
    </div>
	<div class="row">
		<div class="col-lg-6">
			<label class="control-label lfcurunused" for="patches">Пока не понятно, для чего?</label>
			<p class="attention"></p>
			<p><a id="patches" class="btn btn-lg btn-info curunused" href="patches">Патч-панели</a></p>
		</div>
		<div class="col-lg-6">
			<label class="control-label lfcurunused" for="pptypes">Отредактировать патч-панели, временно.</label>
			<p class="attention"></p>
			<p><a id="pptypes" class="btn btn-lg btn-info curunused" href="patchtypes">Типы патч-панелей</a></p>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<label class="control-label lfcurunused" for="ibps">Список моделей ИБП</label>
			<p class="attention"></p>
			<p><a id="ibps" class="btn btn-lg btn-info curunused" href="upsmodels">Модели ИБП</a></p>
		</div>
		<div class="col-lg-6">
			<label class="control-label lfcurunused" for="ibpman">Список производителей ИБП</label>
			<p class="attention"></p>
			<p><a id="ibpman" class="btn btn-lg btn-info curunused" href="upsmanufacturers">Производители ИБП</a></p>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<label class="control-label lfcurunused" for="switches">Список моделей коммутаторов</label>
			<p class="attention"></p>
			<p><a id="switches" class="btn btn-lg btn-info curunused" href="switchmodels">Модели коммутаторов</a></p>
		</div>
		<div class="col-lg-6">
			<label class="control-label lfcurunused" for="swman">Список производителей коммутаторов</label>
			<p class="attention"></p>
			<p><a id="swman" class="btn btn-lg btn-info curunused" href="switchmanufacturers">Производители коммутаторов</a></p>
		</div>
	</div>
</div>
