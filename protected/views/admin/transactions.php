<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
    <div class="row">
        <?php echo $form->label($model,'school'); ?>
        <?php echo $form->dropDownList($model,'school', array(''=>'[any]')+School::getSchools()); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'date_from'); ?>
        <?php echo $form->textField($model,'date_from', array('class' => 'datepicker'/*, 'readonly'=>true*/)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'date_to'); ?>
        <?php echo $form->textField($model,'date_to', array('class' => 'datepicker'/*, 'readonly'=>true*/)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'type'); ?>
        <?php echo $form->dropDownList($model,'type', array(''=>'[any]')+School::getSurfTypes()); ?>
    </div>
    
    <div class="row">
        <?php echo $form->label($model,'full'); ?>
        <?php echo $form->dropDownList($model,'full', array(''=>'[any]', 1=>'Yes', 0=>'No')); ?>
    </div>
    
    <div class="row">
        <?php echo $form->label($model,'subject'); ?>
        <?php echo $form->dropDownList($model,'subject', array(''=>'[any]', 'course'=>'Course', 'equipment'=>'Equipment')); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Filter'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

<? if ($results): ?>
<table class="transactions">
<tr>
	<th>id</th>
	<th>payment gate ID</th>
	<th>user</th>
	<th>school</th>
	<th>date and time</th>
	<th>amount</th>
	<th>100%</th>
	<th>type</th>
	<th>subject</th>
	<th>details</th>
</tr>
<? $sum = 0 ?>
<? foreach ($results as $transaction):?>
<?//var_dump($transaction);?>
<? $sum+=$transaction->amount ?>
<tr>
	<td><?=$transaction->id?></td>
	<td><?=$transaction->token?></td>
	<td><?=$transaction->user->login?></td>
	<td><?=Lang::local($transaction->school->name)?></td>
	<td><?=$transaction->timestamp?></td>
	<td><?=$transaction->amount?></td>
	<td><?=$transaction->full ? 'Yes' : 'No'?></td>
	<td><?=$transaction->type?></td>
	<td><?=$transaction->subject?></td>
	<td><?=str_replace("\n", '<br>', $transaction->details)?></td>
</tr>
<? endforeach;?>
</table>
<span class="total">Total: <?=$sum?></span>
<? endif ?>
