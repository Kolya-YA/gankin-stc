<li>
	<img src="<?=AutoThumb::url('/media/'.$banner->picture, 251, 167)?>" alt="">
	<h3><?=Lang::local($banner->name)?></h3>
	<p><?=Lang::local($banner->description)?></p>
	<? if ($banner->link): ?>
	<a href="<?=$banner->link?>" target='_blank' rel="nofollow"  class="button">Details</a>
	<? else: ?>
	<a href="/banner/<?=$banner->id?>" rel="nofollow"  class="button">Details</a>
	<? endif ?>
</li>
