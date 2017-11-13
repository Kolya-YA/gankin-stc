<div class="small-form">
	<div class="form-title"><?=Yii::t('auth', 'registration')?></div>
	<? if ($done):?>
	<div class="info"><?=Yii::t('auth', 'confirm_email')?></div>
	<? else: ?>
	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

		<div class="label">
			<?php echo $form->labelEx($model,'login'); ?>
			<?php echo $form->textField($model,'login'); ?>
			<?php echo $form->error($model,'login'); ?>
		</div>
		<div class="label">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email'); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		<div class="label">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		<div class="label">
			<?php echo $form->labelEx($model,'password2'); ?>
			<?php echo $form->passwordField($model,'password2'); ?>
			<?php echo $form->error($model,'password2'); ?>
		</div>

		<div class="label buttons">
			<?php echo CHtml::submitButton(Yii::t('auth', 'register_btn')); ?>
		</div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->
	<? endif; ?>
</div>