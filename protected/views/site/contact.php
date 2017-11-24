<?php
    Yii::app()->clientScript->registerMetaTag('Contacs page for tourist who wants to find windsurf, surf and kite lessons in the best schools in Tarifa, Spain', 'description');  
    Yii::app()->clientScript->registerMetaTag('contact,windsurf,surf,kite,lessons,Tarifa', 'keywords');
?>

<div class="grid_8 inner-block">
	<h2 class="h2-border p3">Stay in touch</h2>
	<div class="wrap">
		<?=Lang::local($contacts->content)?>
	</div>
</div>

<div class="grid_4 inner-block">
<div class="bg-white pad-1 top">
	<div class="form-title">Contact form</div>
		<?php if(Yii::app()->user->hasFlash('contact')): ?>

		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('contact'); ?>
		</div>
		<div class="success"><div class="success_txt">Contact form submitted!<br /><strong> We will be in touch soon.</strong></div></div>

		<?php else: ?>

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'form',
			'enableClientValidation'=>false,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>
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