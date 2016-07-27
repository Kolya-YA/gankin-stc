<div class="banners-right">
<? foreach ($banners as $banner): ?>
<div class="right-banner">
	<? if ($banner->link): ?>
	<a href="<?=$banner->link?>" rel="nofollow" target="_blank">
	<? else: ?>
	<a href="<?='/banner/'.$banner->id?>" rel="nofollow"> 
	<? endif ?>
		<h3><?=Lang::local($banner->name)?></h3>
		<img src="<?=AutoThumb::url('/media/'.$banner->picture, 420, 600)?>" alt="">
		<p><?=Lang::local($banner->description)?></p>
	</a>
</div>
<? endforeach ?>
</div>
