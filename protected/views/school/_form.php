<div class="form">

<?php $form=$this->beginWidget('application.widgets.ActiveForm', array(
	'id'=>'school-form',
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
		<?php echo $form->labelEx($model,'short_description'); ?>
		<?php echo $form->multilangField($model,'short_description', array('multiline' => true, 'wysiwyg' => false, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'short_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->multilangField($model,'description', array('multiline' => true, 'wysiwyg' => true)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'picture'); ?>
		<?php echo $form->imageField($model,'picture'); ?>
		<?php echo $form->error($model,'picture'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->textField($model,'owner',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'owner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account'); ?>
		<?php echo $form->textField($model,'account',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'account'); ?>
	</div>

	<div class="row cb-list">
		<?php echo $form->labelEx($model,'beaches'); ?>
		<?php echo $form->checkBoxList($model,'beaches', Location::getLocations()); ?>
		<?php echo $form->error($model,'beaches'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_from'); ?>
		<?php echo $form->textField($model,'work_from',array('size'=>60,'maxlength'=>127,'class'=>'datepicker')); ?>
		<?php echo $form->error($model,'work_from'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'work_to'); ?>
		<?php echo $form->textField($model,'work_to',array('size'=>60,'maxlength'=>127,'class'=>'datepicker')); ?>
		<?php echo $form->error($model,'work_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model,'latitude',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->textField($model,'longitude',array('size'=>60,'maxlength'=>127)); ?>
		<?php echo $form->error($model,'longitude'); ?>
	</div>
	
	<div class="row">
		<label for="map_code">Or insert map code here</label>
		<textarea style="width:100%;height:100px;" id="map_code"></textarea>
	</div>

	
	<? foreach (School::getSurfTypes() as $k => $v): ?>
	<div class="row branch" data-type="<?=$k?>">
		<label><input class="branch-switch" type="checkbox" name="branch[<?=$k?>]" value="1" <?=$model->branches[$k]->id ? 'checked' : false?>/><?=$v?></label>
		<fieldset>
			<div class="prices">
				<h2>Lesson prices</h2>
				<table>
				<tr>
					<th>Hours</th>
					<? foreach (School::getDurations() as $d): ?>
					<th><?=$d?></th>
					<? endforeach ?>
				</tr>
				<? foreach (School::getLessonTypes() as $lk => $lv): ?>
				<tr>
					<td><?=$lv?></td>
					<? foreach (School::getDurations() as $dk => $dv): ?>
					<?/*D::dump($model->prices[$k][$lk][$dk])*/?>
					<td><?php echo $form->textField($model->prices[$k][$lk][$dk],'price', array(
						'data-duration' => $dk,
						'data-type' => $lk,
						)) ?></td>
					<? endforeach ?>
				</tr>
				<? endforeach ?>
				</table>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model->branches[$k],'instructors'); ?>
				<?php echo $form->numberField($model->branches[$k],'instructors', array('min' => 0)) ?>
				<?php echo $form->error($model,'instructors'); ?>
			</div>
			<div class="clear"></div>
			<div class="row">
				<?php echo $form->labelEx($model->branches[$k],'rent'); ?>
				<?php echo $form->checkBox($model->branches[$k],'rent') ?>
				<?php echo $form->error($model,'rent'); ?>
			</div>
			<div class="row rent-prices">
				<?php echo $form->labelEx($model->branches[$k],'rent_prices'); ?>
				<?php echo $form->listField($model->branches[$k],'rent_prices', array('size'=>14, 'cols'=>in_array($k, array('kite', 'wind')) ? 3 : 1)) ?>
				<?php echo $form->error($model,'rent_price_day'); ?>
			</div>
		</fieldset>
	</div>
	<? endforeach ?>
	
	<? if (Yii::app()->user->role == 'admin'): ?>
<!--	<div class="row">
		<?php echo $form->labelEx($model,'on_index'); ?>
		<?php echo $form->checkBox($model,'on_index'); ?>
		<?php echo $form->error($model,'on_index'); ?>
	</div>-->
	<? endif ?>
	
	<? if ($model->scenario == 'school'): ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'accept'); ?>
		<?php echo $form->checkBox($model, 'accept'); ?>
		<?php echo $form->error($model, 'accept'); ?>
	</div>
	<? endif ?>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->