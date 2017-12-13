<div class="small-form">
	<h2 class="form-title"><?=Yii::t('auth', 'registration')?></h2>

	<? if ($done):?>
	<div class="info"><?=Yii::t('auth', 'confirm_email')?></div>
	<? else: ?>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

		<?= $form->labelEx($model,'login'); ?>
		<?= $form->textField($model,'login'); ?>
		<?= $form->error($model,'login'); ?>

		<?= $form->labelEx($model,'email'); ?>
		<?= $form->textField($model,'email'); ?>
		<?= $form->error($model,'email'); ?>

		<?= $form->labelEx($model,'password'); ?>
		<?= $form->passwordField($model,'password'); ?>
		<?= $form->error($model,'password'); ?>

		<?= $form->labelEx($model,'password2'); ?>
		<?= $form->passwordField($model,'password2'); ?>
		<?= $form->error($model,'password2'); ?>

		<button class="button"><?= Yii::t('auth', 'register_btn'); ?></button>

	<?php $this->endWidget(); ?>
	<? endif; ?>
	
</div>