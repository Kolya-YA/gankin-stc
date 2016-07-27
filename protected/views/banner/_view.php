<?php
/* @var $this BannerController */
/* @var $data Banner */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keywords')); ?>:</b>
	<?php echo CHtml::encode($data->keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('picture')); ?>:</b>
	<?php echo CHtml::encode($data->picture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('top_index')); ?>:</b>
	<?php echo CHtml::encode($data->top_index); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('index')); ?>:</b>
	<?php echo CHtml::encode($data->index); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('left_course')); ?>:</b>
	<?php echo CHtml::encode($data->left_course); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('right_course')); ?>:</b>
	<?php echo CHtml::encode($data->right_course); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('left_equipment')); ?>:</b>
	<?php echo CHtml::encode($data->left_equipment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('right_equipment')); ?>:</b>
	<?php echo CHtml::encode($data->right_equipment); ?>
	<br />

	*/ ?>

</div>
