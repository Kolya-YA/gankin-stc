<?php
	$this->pageTitle = Lang::local($page->name) . ' | ' . Yii::app()->name;
	Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');
	Yii::app()->clientScript->registerMetaTag(Lang::local($page->keywords), 'keywords');
	Yii::app()->clientScript->registerScriptFile('/js/jquery.jqtransform.js', CClientScript::POS_BEGIN);
	Yii::app()->clientScript->registerScriptFile('/js/jquery.datepicker.min.js', CClientScript::POS_END);
?>

<div class="inner-page">

	<? if (is_array($schools)):?>
		<div class="inner-page__search-result">
			<h2><?=Yii::t('search', 'surf_equipment')?></h2>
			<div class="search-result">
				<? if ($schools): ?>
				<ul>
					<? foreach ($schools as $school)
						$this->renderPartial('_item', array('school' => $school, 'filter' => $filter));
					?>
				</ul>
				<? else: ?>
				<?=Yii::t('app', 'no_results')?>
				<? endif; ?>
			</div>
		</div>
	<? endif; ?>
	
	<div class="inner-page__internal-wrapper">
		<article class="inner-page__page-content">
			<?= Lang::local($page->content); ?>	
		</article>
	
		<div class="inner-page__form"> 
			<div class="main-search">
				<h2 class="main-search__title"><?= Yii::t('search', 'equip_form') ?></h2>  
				<!-- <img src="/images/icon2.jpg" class="side-ico"> -->
				<?php $form=$this->beginWidget('application.widgets.ActiveForm', array(
					'id'=>'form2',
					'enableAjaxValidation'=>false,
					'action' => '/equipment',
					'htmlOptions' => array('class' => 'form-style-2'),
				)); ?>
	
				<?= $form->errorSummary($model) ?>
				<div class="label">
					<span><?=$form->label($model, 'location')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'location', array(0=>Yii::t('search', 'all_regions'))+Location::getLocations())?>
					</strong>
					<span class="clear"></span>
				</div>
	
				<div class="label">
					<span><?=$form->label($model, 'type')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'type', array(''=>Yii::t('search', 'select_one'))+School::getSurfTypes())?>
					</strong>
					<span class="clear"></span>
				</div>
				<div class="label rent-type kite">
					<span></span>
					<strong class="select2">
					<?=$form->radioButtonList($model, 'rent_type', $model->rentTypes('kite'), array('disabled'=>1))?>
					</strong>
					<span class="clear"></span>
				</div>
				<div class="label rent-type wind">
					<span></span>
					<strong class="select2">
					<?=$form->radioButtonList($model, 'rent_type', $model->rentTypes('wind'), array('disabled'=>1))?>
					</strong>
					<span class="clear"></span>
				</div>
				<div class="label">
					<strong class="col-1">
					<span><?=$form->label($model, 'pick_date')?></span>
					<?=$form->textField($model, 'pick_date', array('class' => 'inp-1  datepicker'))?>
					<span class="clear"></span>
					</strong>
					<span class="clear"></span>
				</div>
				<div class="label">
					<span><?=$form->label($model, 'days')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'days', School::getDays())?>
					</strong>
					<span class="clear"></span>
				</div>
				
				<div class="label">
					<span><?=$form->label($model, 'count')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'count', School::getDays())?>
					</strong>
					<span class="clear"></span>
				</div>
				<!-- <a onClick="document.getElementById('form2').submit();return false;" href="#" class="button"><?=Yii::t('search', is_array($schools) ? 'new_search_btn' : 'search_btn')?></a> -->
				<button class="button"><?=Yii::t('search', is_array($schools) ? 'new_search_btn' : 'search_btn')?></button>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>

</div>

<div class="inner-page__banners">
	<? $this->renderPartial('/banner/left', array('banners' => $banners_left))?>
</div>

