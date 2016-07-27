<?php

class ActiveForm extends CActiveForm
{
	public function multilangField($model,$attribute,$htmlOptions=array())
	{
		$class = get_class($model);
		$multiline = isset($htmlOptions['multiline']) && $htmlOptions['multiline'];
		$wysiwyg = isset($htmlOptions['wysiwyg']) && $htmlOptions['wysiwyg'];
		$maxlength = isset($htmlOptions['maxlength']) && $htmlOptions['maxlength'] ? intval($htmlOptions['maxlength']) : 0;
		$val = $model->$attribute;
	?>
		<div class='multilang-field'>
			<div class="buttons">
				<? foreach (Lang::getSiteLangs() as $l => $lang): ?>
				<img src="/images/flag/<?=$l?>.png" data-lang="<?=$l?>" class="switch <?=$l=='en' ? 'active' : false?>" />
				<? endforeach ?>
			</div>
			
			<div class="editors">
			<? foreach (Lang::getSiteLangs() as $l => $lang): 
				$v = isset($val[$l]) ? $val[$l] : false;
			?>
				<div data-lang="<?=$l?>" class="editor">
				<? if ($multiline): ?>
				<textarea <?=$maxlength ? 'maxlength='.$maxlength : false?> class="<?=$wysiwyg ? 'wysiwyg' : false ?>" name='<?=$class?>[<?=$attribute?>][<?=$l?>]'><?=$v?></textarea>
				<? else: ?>
				<input type="text" name='<?=$class?>[<?=$attribute?>][<?=$l?>]' value="<?=$v?>"/>
				<? endif ?>
				</div>
			<? endforeach ?>
			</div>
		</div>
		<? if ($maxlength && $multiline): ?>
		max length: <?=$maxlength?>
		<? endif ?>
	<?}

	public function imageField($model,$attribute,$htmlOptions=array())
	{
		$class = get_class($model);
		$value = $model->$attribute;
	?>
		<? if($value):?>
		<a href="<?='/media/'.$model->$attribute?>" target="_blank"><img src="<?=AutoThumb::url('/media/'.$model->$attribute, 80, 80)?>"/></a>
<!-- 		<label><input type="checkbox" name="<?=$class?>[<?=$attribute?>_delete]" value=1 /> Удалить</label> -->
		<? endif; ?>
		<input id="yt<?=$class?>_<?=$attribute?>" type="hidden" value="<?=$value?>" name="<?=$class?>[<?=$attribute?>]" />
		<input name="<?=$class?>[<?=$attribute?>]" id="<?=$class?>_<?=$attribute?>" type="file" />
	<?}
	
	public function listField($model,$attribute,$options=array())
	{
		$names = array('All', 'Board', 'Kite/Sail');
		$size = $options['size'];
		$cols = $options['cols'];
		$class = get_class($model);
		$values = $model->$attribute;
		if (!is_array($values))
			$values = json_decode($values, true);
		if (sizeof($values) != $cols)
		{
			$values = array();
			for ($i = 0; $i < $cols; $i++)
				$values[$i] = array_fill(0, $size, 0);
		}
	?>
		<? for ($col = 0; $col < $cols; $col++): ?>
		<div class="column">
			<?=$names[$col]?>
			<? for ($i = 0; $i<$size; $i++):?>
			<label><span class="rent-days"><?=$i+1?></span>
			<input id="yt<?=$class?>_<?=$attribute?>[<?=$i?>]" type="text" value="<?=$values[$col][$i]?>" name="<?=$class?>[<?=$attribute?>][<?=$col?>][]" />
			</label>
			<? endfor; ?>
		</div>
		<? endfor; ?>
		<div class="clear"></div>
	<?}
}