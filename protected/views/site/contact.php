<?php
	$this->pageTitle = Lang::local($contacts->name) . ' | ' . Yii::app()->name;
	Yii::app()->clientScript->registerMetaTag(Lang::local($contacts->short_description), 'description');
	Yii::app()->clientScript->registerMetaTag(Lang::local($contacts->keywords), 'keywords');
?>

<div class="inner-page">

	<div class="inner-page__internal-wrapper">
		<article class="inner-page__page-content">
			<h2><?=Lang::local($contacts->name)?></h2>
			<?=Lang::local($contacts->content)?>
		</article>
	
		<div class="inner-page__form">
	
			<div class="contact-form">
	
				<h2 class="contact-form__title">Contact form</h2>
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
							
								<?php echo $form->labelEx($model,'name'); ?>
								<?php echo $form->textField($model,'name', array('placeholder' => Yii::t('form', 'name'))); ?>
								<?php echo $form->error($model,'name'); ?>
							
								<?php echo $form->labelEx($model,'email'); ?>
								<?php echo $form->emailField($model,'email', array('placeholder' => 'E-mail')); ?>
								<?php echo $form->error($model,'email'); ?>

								<?php echo $form->labelEx($model,'body'); ?>
								<?php echo $form->textArea($model,'body',array('placeholder' => Yii::t('form', 'message'))); ?>
								<?php echo $form->error($model,'body'); ?>
							
							<div class="btns">
								<button type="reset" class="button"><?=Yii::t('form', 'reset')?></button>
								<a href="#" data-type="submit" class="button" onclick="document.getElementById('form').submit();return false;"><?=Yii::t('form', 'submit')?></a>
							</div>
		
					<?php $this->endWidget(); ?>
					<? endif ?>
			</div>
		</div>
	</div>

</div>