<?php
/**
* @var $news array of news for render
**/
?>
<div class="lastest-news">
	
	<h2 class="lastest-news__header"><?=Yii::t('app', 'lastnews')?></h2>
	<a href="/news" class="lastest-news__link-all"><?=Yii::t('app', 'seeall')?></a>
	<ul class="lastest-news__list">

		<? foreach ($news as $n): ?>

		<li class="lastest-news__item">
			<a class="lastest-news__link" href="/news/<?=$n->id?>">

			<div class="lastest-news__date">
				<?=date('d.m.Y', strtotime($n->created))?>
			</div>

			<h3 class="lastest-news__head"><?=Lang::local($n->name)?></h3>
			<p class="lastest-news__dscr"><?=Lang::local($n->description)?></p>

			<div class="lastest-news__more">
				<?=Yii::t('app', 'more')?>
			</div>

			</a>
		</li>

		<? endforeach; ?>

	</ul>
	<a href="/news" class="lastest-news__link-all"><?=Yii::t('app', 'seeall')?></a>
</div>