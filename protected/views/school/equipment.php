<?php
	$this->pageTitle = Lang::local($page->name) . ' | ' . Yii::app()->name;
	Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');
	Yii::app()->clientScript->registerMetaTag(Lang::local($page->keywords), 'keywords');
//	Yii::app()->clientScript->registerScriptFile('/js/jquery.jqtransform.js', CClientScript::POS_BEGIN);
//	Yii::app()->clientScript->registerScriptFile('/js/jquery.datepicker.min.js', CClientScript::POS_END);
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
					'htmlOptions' => array('class' => 'find-form'),
				)); ?>
	
				<?= $form->errorSummary($model) ?>

				<div class="find-form__row">
					<?=$form->label($model, 'type')?>
					<?=$form->dropDownList($model, 'type', array(''=>Yii::t('search', 'select_one'))+School::getSurfTypes())?>
				</div>

				<div class="find-form__row rent-type kite">
					<?=$form->radioButtonList($model, 'rent_type', $model->rentTypes('kite'), $model->radioOptions())?>
				</div>

				<div class="find-form__row rent-type wind">
					<?=$form->radioButtonList($model, 'rent_type', $model->rentTypes('wind'), $model->radioOptions())?>
				</div>

				<div class="find-form__row">
					<?=$form->label($model, 'pick_date')?>
					<?=$form->dateField($model, 'pick_date', $model->datePickerOptions())?>
				</div>

<!--                <div class="find-form__row">-->
<!--					--><?//=$form->label($model, 'pick_date')?>
<!--					--><?//=$form->textField($model, 'pick_date', array('class' => 'inp-1  datepicker'))?>
<!--				</div>-->

				<div class="find-form__row">
					<?=$form->label($model, 'days')?>
					<?=$form->dropDownList($model, 'days', School::getDays())?>
				</div>
				
				<div class="find-form__row">
					<?=$form->label($model, 'count')?>
					<?=$form->dropDownList($model, 'count', array_combine(range(1,5),range(1,5)))?>
				</div>

                <div class="find-form__row">
                    <?=$form->label($model, 'location')?>
                    <?=$form->dropDownList($model, 'location', array(0=>Yii::t('search', 'all_regions'))+Location::getLocations())?>
                </div>

				<button class="button"><?=Yii::t('search', is_array($schools) ? 'new_search_btn' : 'search_btn')?></button>
				<?php $this->endWidget(); ?>

			</div>
		</div>
	</div>

</div>

<div class="inner-page__banners">
	<? $this->renderPartial('/banner/left', array('banners' => $banners_left))?>
</div>