<ul>
<? foreach ($banners as $banner): ?>
<li>
	<img src="<?=AutoThumb::url('/media/'.$banner->picture, 150, 200)?>" alt="">
	<h3><?=Lang::local($banner->name)?></h3>
	<p><?=Lang::local($banner->description)?></p>
	<div class="clear"></div>
	<div class="price-block">
		<? if ($banner->link): ?>
		<a href="<?=$banner->link?>" rel="nofollow" class="button" target="_blank">
		<? else: ?>
		<a href="<?='/banner/'.$banner->id?>" rel="nofollow" class="button">
		<? endif ?>
			<?=Yii::t('app', 'details')?>
		</a>
	</div>
	<div class="clear"></div>
</li>
<? endforeach?>
</ul>
