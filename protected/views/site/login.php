<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="small-form">
	<div class="form-title"><?=Yii::t('auth', 'login')?></div>
	
	<div class="login-text"><?=Yii::t('auth', 'login_text')?></div>

	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

		<div class="label">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="label">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>

		<div class="register">
			<a href="/recovery"><?=Yii::t('auth', 'recover')?></a>
		</div>

		<div class="label rememberMe">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe', array('class'=>'wide')); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</div>
		
		<div class="label buttons">
			<?php echo CHtml::submitButton(Yii::t('auth', 'login_btn')); ?>
		</div>

		<div class="register">
			<span class="register-text">
				<?=Yii::t('auth', 'new_user')?><a href="/register" class="register-link"><?=Yii::t('auth', 'register')?></a>
			</span>
		</div>
	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>