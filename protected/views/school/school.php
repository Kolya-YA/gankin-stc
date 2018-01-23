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
				<h2 class="main-search__title"><?=Yii::t('search', 'school_form')?></h2>
				<!-- <img src="/images/icon1.jpg" class="side-ico"> -->
				<?php $form = $this->beginWidget('application.widgets.ActiveForm', [
					'id' => 'form2',
					'enableAjaxValidation' => false,
					'action' => '/school',
					'htmlOptions' => ['class' => 'find-form'],
                ]); ?>
				
				<?= $form->errorSummary($model) ?>
				
                <div class="find-form__row">
					<?=$form->label($model, 'type')?>
					<?=$form->dropDownList($model, 'type', [''=>Yii::t('search', 'select_one')] + School::getSurfTypes())?>
				</div>
	
				<div class="find-form__row">
					<?=$form->label($model, 'date_from')?>
                    <?=$form->dateField($model, 'date_from')?>
				</div>

				<div class="find-form__row">
					<?=$form->label($model, 'date_to')?>
					<?=$form->dateField($model, 'date_to')?>
				</div>
				
				<div class="find-form__row">
					<?=$form->label($model, 'amount')?>
					<?=$form->dropDownList($model, 'amount', School::getDays())?>
				</div>
	
				<div class="find-form__row">
					<?=$form->label($model, 'age')?>
					<?=$form->textField($model, 'age')?>
				</div>
	
				<div class="find-form__row">
					<?=$form->label($model, 'sex')?>
					<?=$form->dropDownList($model, 'sex', 
						array(0=>Yii::t('search', 'select_one'))
						+array('male' => Yii::t('app', 'male'), 'female' => Yii::t('app', 'female')))?>
				</div>

				<div class="find-form__row">
					<?=$form->label($model, 'level')?>
					<?=$form->dropDownList($model, 'level',
						array(0=>Yii::t('search', 'select_one'))+School::getSkills())?>
				</div>

				<div class="note">
                    <?=Yii::t('search', 'hilevel_info')?>
                </div>

				<div class="find-form__row">
					<?=$form->label($model, 'lesson')?>
					<?=$form->dropDownList($model, 'lesson',
						array(''=>Yii::t('search', 'select_one'))+School::getLessonTypes())?>
				</div>

				<div class="find-form__row">
					<?=$form->label($model, 'language')?>
					<?=$form->dropDownList($model, 'language',
						array(0=>Yii::t('search', 'select_one'))+Lang::getLangs())?>
				</div>

                <div class="find-form__row">
					<?=$form->label($model, 'duration')?>
					<?=$form->dropDownList($model, 'duration',
						array(''=>Yii::t('search', 'select_one'))+School::getDurations())?>
				</div>

                <div class="find-form__row">
                    <?=$form->label($model, 'location')?>
                    <?=$form->dropDownList($model, 'location', array(0=>Yii::t('search', 'all_regions'))+Location::getLocations())?>
                </div>

                <button class="button"><?=Yii::t('search', is_array($schools) ? 'new_search_btn' : 'search_btn')?></button>
<!--            <a onClick="document.getElementById('form2').submit();return false;" href="#" class="button">--><?//=Yii::t('search', is_array($schools) ? 'new_search_btn' : 'search_btn')?><!--</a>-->
				<?php $this->endWidget(); ?>
			</div>
		</div>

	</div>

</div>

<div class="inner-page__banners">
<!--	--><?// $this->renderPartial('/banner/right', array('banners' => $banners_right)) ?>
	<? $this->renderPartial('/banner/left', array('banners' => $banners_left))?>
</div>