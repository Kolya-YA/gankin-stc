<article class="banner-preview">
	<h2 class="banner-preview__head"><?=Lang::local($banner->name)?></h2>
	<img class="banner-preview__img" src="<?=AutoThumb::url('/media/'.$banner->picture, $pic_width, $pic_height)?>" alt="<?=Lang::local($banner->name)?>">
<!--	<img class="banner-preview__img" src="--><?//=AutoThumb::url('/media/'.$banner->picture, 251, 167)?><!--" alt="">-->
	<p class="banner-preview__text"><?=Lang::local($banner->description)?></p>
	<? if ($banner->link): ?>
	<a href="<?=$banner->link?>" target='_blank' rel="nofollow noopener" class="button banner-preview__link">
	<? else: ?>
	<a href="/banner/<?=$banner->id?>" class="button banner-preview__link">
	<? endif ?>
    <?=Yii::t('app', 'details')?>
    </a>
</article>