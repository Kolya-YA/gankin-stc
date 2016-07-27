<div class="lang-switch">
	<? foreach (Lang::getSiteLangs() as $code => $name): ?>
	<a href="<?php echo Lang::getCurrentUrl($code)?>" data-lang=<?=$code?>><img src="/images/lang/<?=$code?>.png" alt="<?=$code?>"/></a>
	<? endforeach ?>
</div>

<?
/*

<select name="select" id="lang-switch" class="">
	<? foreach (Lang::getSiteLangs() as $code => $name): ?>
	<option ico="/images/flag/<?=$code?>.png" value="<?=$code?>" <?=$code == $lang ? 'selected' : false?>><?=$name?></option>
	<? endforeach ?>
</select>
*/