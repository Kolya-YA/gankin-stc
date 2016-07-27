<?php
/* @var $this CourseController */
/* @var $data Course */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_id')); ?>:</b>
	<?php echo CHtml::encode($data->school_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('languages')); ?>:</b>
	<?php echo CHtml::encode($data->languages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lesson_type')); ?>:</b>
	<?php echo CHtml::encode($data->lesson_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_age')); ?>:</b>
	<?php echo CHtml::encode($data->min_age); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_age')); ?>:</b>
	<?php echo CHtml::encode($data->max_age); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	<?php echo CHtml::encode($data->duration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('skill')); ?>:</b>
	<?php echo CHtml::encode($data->skill); ?>
	<br />

	*/ ?>

</div>