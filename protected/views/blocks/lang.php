<div class="lang-switch">
	<? foreach (Lang::getSiteLangs() as $code => $name): ?>
	<a href="<?php echo Lang::getCurrentUrl($code)?>" data-lang=<?=$code?>><?=$code?></a>
	<!-- <a href="<?php echo Lang::getCurrentUrl($code)?>" data-lang=<?=$code?>><img src="/images/lang/<?=$code?>.png" alt="<?=$code?>"/></a> -->
	<? endforeach ?>
</div>