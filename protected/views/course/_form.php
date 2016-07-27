<div class="form">

<?php $form=$this->beginWidget('application.widgets.ActiveForm', array(
	'id'=>'course-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'school_id'); ?>
		<?php echo $form->dropDownList($model,'school_id', School::getSchools()); ?>
		<?php echo $form->error($model,'school_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', School::getSurfTypes()); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row cb-list">
		<?php echo $form->labelEx($model,'languages'); ?>
		<?php echo $form->checkBoxList($model,'languages', Lang::getLangs(), array('multiple'=>1, 'size' => 4)); ?>
		<?php echo $form->error($model,'languages'); ?>
	</div>

	<div class="row cb-list">
		<?php echo $form->labelEx($model,'lesson_type'); ?>
		<?php echo $form->checkBoxList($model,'lesson_type', School::getLessonTypes(), array('multiple'=>1, 'size' => 3)); ?>
		<?php echo $form->error($model,'lesson_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'min_age'); ?>
		<?php echo $form->numberField($model,'min_age', array('min' => 0)); ?>
		<?php echo $form->error($model,'min_age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_age'); ?>
		<?php echo $form->numberField($model,'max_age', array('min' => 0)); ?>
		<?php echo $form->error($model,'max_age'); ?>
	</div>

	<div class="row cb-list">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->checkBoxList($model,'sex', array('male' => 'Male', 'female' => 'Female'), array('multiple' => 1, 'size' => 2)); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row cb-list">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->checkBoxList($model,'duration', School::getDurations(), array('multiple'=>1, 'size' => 5)); ?>
		<?php echo $form->error($model,'duration'); ?>
	</div>

	<div class="row cb-list">
		<?php echo $form->labelEx($model,'skill'); ?>
		<?php echo $form->checkBoxList($model,'skill', School::getSkills(), array('multiple'=>1, 'size' => 3)); ?>
		<?php echo $form->error($model,'skill'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->