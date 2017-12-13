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
			<h2 class="inner-page__header"><?=Yii::t('search', 'surf_schools')?></h2>
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
	<?endif; ?>

	<div class="inner-page__internal-wrapper">

		<article class="inner-page__page-content">
			<?= Lang::local($page->content); ?>
		</article>
		
		<div class="inner-page__form">
			<div class="main-search">
				<h2 class="form-title"><?=Yii::t('search', 'school_form')?></h2>  
				<!-- <img src="/images/icon1.jpg" class="side-ico"> -->
				<?php $form=$this->beginWidget('application.widgets.ActiveForm', array(
					'id'=>'form2',
					'enableAjaxValidation'=>false,
					'action' => '/school',
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
	
				<div class="label">
					<strong class="col-1">
					<span><?=$form->label($model, 'date_from')?></span>
					<?=$form->textField($model, 'date_from', array('class' => 'inp-1  datepicker'))?>
					<span class="clear"></span>
					</strong>
					<span class="clear"></span>
				</div>
				<div class="label">
					<strong class="col-1">
					<span><?=$form->label($model, 'date_to')?></span>
					<?=$form->textField($model, 'date_to', array('class' => 'inp-1  datepicker'))?>
					<span class="clear"></span>
					</strong>
					<span class="clear"></span>
				</div>
				
				<div class="label">
					<span><?=$form->label($model, 'amount')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'amount', School::getDays())?>
					</strong>
					<span class="clear"></span>
				</div>
	
				<div class="label">
					<span><?=$form->label($model, 'age')?></span>
					<?=$form->textField($model, 'age', array('class' => 'inp-2'))?>
					<span class="clear"></span>
				</div>
	
				<div class="label">
					<span><?=$form->label($model, 'sex')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'sex', 
						array(0=>Yii::t('search', 'select_one'))
						+array('male' => Yii::t('app', 'male'), 'female' => Yii::t('app', 'female')))?>
					</strong>
					<span class="clear"></span>
				</div>
				<div class="label">
					<span><?=$form->label($model, 'level')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'level', 
						array(0=>Yii::t('search', 'select_one'))+School::getSkills())?>
					</strong>
					<span class="clear"></span>
				</div>
				<div class="note"><?=Yii::t('search', 'hilevel_info')?></div>
				<div class="label">
					<span><?=$form->label($model, 'lesson')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'lesson', 
						array(''=>Yii::t('search', 'select_one'))+School::getLessonTypes())?>
					</strong>
					<span class="clear"></span>
				</div>
				<div class="label">
					<span><?=$form->label($model, 'language')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'language', 
						array(0=>Yii::t('search', 'select_one'))+Lang::getLangs())?>
					</strong>
					<span class="clear"></span>
				</div>
				<div class="label">
					<span><?=$form->label($model, 'duration')?></span>
					<strong class="select2">
					<?=$form->dropDownList($model, 'duration', 
						array(''=>Yii::t('search', 'select_one'))+School::getDurations())?>
					</strong>
					<span class="clear"></span>
				</div>
	
				<a onClick="document.getElementById('form2').submit();return false;" href="#" class="button"><?=Yii::t('search', is_array($schools) ? 'new_search_btn' : 'search_btn')?></a>
				<?php $this->endWidget(); ?>
			</div>
			<?= $this->renderPartial('/banner/right', array('banners' => $banners_right)) ?>
		</div>
	
	</div>

</div>

<div class="inner-page__banners">
	<? $this->renderPartial('/banner/left', array('banners' => $banners_left))?>
</div>