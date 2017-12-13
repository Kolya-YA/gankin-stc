<?php
/* @var $this BannerController */
/* @var $model Banner */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('rows'=>2, 'cols'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>2, 'cols'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'keywords'); ?>
		<?php echo $form->textField($model,'keywords',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>127)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textField($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'picture'); ?>
		<?php echo $form->textField($model,'picture',array('size'=>60,'maxlength'=>127)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'top_index'); ?>
		<?php echo $form->textField($model,'top_index'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'index'); ?>
		<?php echo $form->textField($model,'index'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'left_course'); ?>
		<?php echo $form->textField($model,'left_course'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'right_course'); ?>
		<?php echo $form->textField($model,'right_course'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'left_equipment'); ?>
		<?php echo $form->textField($model,'left_equipment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'right_equipment'); ?>
		<?php echo $form->textField($model,'right_equipment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
