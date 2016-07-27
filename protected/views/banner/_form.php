<?php
/* @var $this BannerController */
/* @var $model Banner */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('application.widgets.ActiveForm', array(
	'id'=>'banner-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->multilangField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->multilangField($model,'description', array('multiline' => true, 'wysiwyg' => false, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->multilangField($model,'keywords', array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'keywords'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->multilangField($model,'content', array('multiline' => true, 'wysiwyg' => true)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'picture'); ?>
		<?php echo $form->imageField($model,'picture'); ?>
		<?php echo $form->error($model,'picture'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'top_index'); ?>
		<?php echo $form->checkBox($model,'top_index'); ?>
		<?php echo $form->error($model,'top_index'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'index'); ?>
		<?php echo $form->checkBox($model,'index'); ?>
		<?php echo $form->error($model,'index'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'left_course'); ?>
		<?php echo $form->checkBox($model,'left_course'); ?>
		<?php echo $form->error($model,'left_course'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'right_course'); ?>
		<?php echo $form->checkBox($model,'right_course'); ?>
		<?php echo $form->error($model,'right_course'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'left_equipment'); ?>
		<?php echo $form->checkBox($model,'left_equipment'); ?>
		<?php echo $form->error($model,'left_equipment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'right_equipment'); ?>
		<?php echo $form->checkBox($model,'right_equipment'); ?>
		<?php echo $form->error($model,'right_equipment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'search_result'); ?>
		<?php echo $form->checkBox($model,'search_result'); ?>
		<?php echo $form->error($model,'search_result'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'payment'); ?>
		<?php echo $form->checkBox($model,'payment'); ?>
		<?php echo $form->error($model,'payment'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->checkBox($model,'mail'); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
