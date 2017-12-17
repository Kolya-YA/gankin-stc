<section>
<? foreach ($banners as $banner): ?>
<article class="banner-preview">
	<h2 class="banner-preview__head"><?=Lang::local($banner->name)?></h2>
	<img class="banner-preview__img" src="<?=AutoThumb::url('/media/'.$banner->picture, 150, 200)?>" alt="">
	<p class="banner-preview__text"><?=Lang::local($banner->description)?></p>
		<? if ($banner->link): ?>
		<a href="<?=$banner->link?>" rel="nofollow noopener" class="button banner-preview__link" target="_blank">
		<? else: ?>
		<a href="<?='/banner/'.$banner->id?>" rel="nofollow" class="button banner-preview__link">
		<? endif ?>
			<?=Yii::t('app', 'details')?>
		</a>
</article>
<? endforeach?>
</section>
