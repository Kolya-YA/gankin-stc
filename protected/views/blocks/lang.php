<div class="lang-switch">
	<? foreach (Lang::getSiteLangs() as $code => $name): ?>
	<a href="<?php echo Lang::getCurrentUrl($code)?>" data-lang=<?=$code?> hreflang=<?=$code?>><?=$code?></a>
	<? endforeach ?>
</div>