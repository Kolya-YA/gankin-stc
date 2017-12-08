<?php
	$this->pageTitle = Lang::local($contacts->name) . ' | ' . Yii::app()->name;
	Yii::app()->clientScript->registerMetaTag(Lang::local($contacts->short_description), 'description');
	Yii::app()->clientScript->registerMetaTag(Lang::local($contacts->keywords), 'keywords');
?>

<div class="inner-page">

	<article class="inner-page__page-content">
		<h2><?=Lang::local($contacts->name)?></h2>
		<?=Lang::local($contacts->content)?>
	</article>

	<div class="inner-page__form">

		<div class="pad-1">

			<div class="form-title">Contact form</div>
				<?php if (Yii::app()->user->hasFlash('contact')): ?>
	
				<div class="flash-success">
					<?php echo Yii::app()->user->getFlash('contact'); ?>
				</div>
				
				<div class="success"><div class="success_txt">Contact form submitted!<br /><strong> We will be in touch soon.</strong></div></div>
	
				<?php else: ?>
	
				<?php
					$form=$this->beginWidget('CActiveForm', array(
						'id'=>'form',
						'enableClientValidation'=>false,
						'clientOptions'=>array(
							'validateOnSubmit'=>true,
						),
					));
				?>
				<?php /*echo $form->errorSummary($model);*/ ?>
					
					<fieldset>
	
						<label class="name">
							<?php echo $form->textField($model,'name', array('placeholder' => Yii::t('form', 'name'))); ?>
							<?php echo $form->error($model,'name'); ?>
						</label>
	
						<label class="email">
							<?php echo $form->textField($model,'email', array('placeholder' => 'E-mail')); ?>
							<?php echo $form->error($model,'email'); ?>
						</label>
	
						<label class="message">
							<?php echo $form->textArea($model,'body',array('placeholder' => Yii::t('form', 'message'))); ?>
							<?php echo $form->error($model,'body'); ?>
						</label>
						
						<div class="btns">
							<a data-type="reset" class="button" href="#" onclick="document.getElementById('form').reset();return false;"><?=Yii::t('form', 'reset')?></a>
							<a href="#" data-type="submit" class="button" onclick="document.getElementById('form').submit();return false;"><?=Yii::t('form', 'submit')?></a>
						</div>
	
					</fieldset>
	
				<?php $this->endWidget(); ?>
				<? endif ?>
		</div>
	</div>

</div>