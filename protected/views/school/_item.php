<li>
	<img src="<?=AutoThumb::url('/media/'.$school->picture, 150, 200)?>" alt="">
	<h3><a href="/school/<?=$school->id?>"><?=Lang::local($school->name)?></a></h3>
	<p><?=Lang::local($school->short_description)?></p>
	<? if ($school->price): ?>
	<div class="price-block">
		<p class="price">€<?=$school->price?></p>
		<a href="<?=/*Yii::app()->user->isGuest ? '/login' : */'/school/order?id='.$school->id.'&filter='.$filter.'#order'?>" class="button"><?=Yii::t('app', 'order')?></a>
	</div>
	<? endif ?>
</li>