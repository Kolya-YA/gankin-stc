<h2 class="h2-border"><?=Yii::t('app', 'lastnews')?><!-- <a href="/news" class="link"><?=Yii::t('app', 'seeall')?></a>--></h2>
<ul class="box-2 lastnews">
	<? foreach ($news as $n): ?>
	<li>
	<a href="/news/<?=$n->id?>" class="link-2"><?=date('d.m.Y', strtotime($n->created))?></a><a href="/news/<?=$n->id?>"><h3><?=Lang::local($n->name)?></h3></a>
		<p><a href="/news/<?=$n->id?>" class="link-3"><?=Lang::local($n->description)?></a></p>
		<a href="/news/<?=$n->id?>" class="link-3 more"><?=Yii::t('app', 'more')?></a>
	</li>
	<? endforeach; ?>
</ul>
