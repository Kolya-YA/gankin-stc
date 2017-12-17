<!-- <h2><?=Yii::t('app', 'bestoffer')?></h2> -->
<!--<a href="#" class="link"><?=Yii::t('app', 'seeall')?></a>-->
<section class="article-list">

	<?
	for ($i = 0; $i < (int)((sizeof($best_offer) + 1) / 2); $i++)
		$this->renderPartial('/banner/index', array('banner' => $best_offer[$i * 2]));
	 
	for ($i = 0; $i < (int)((sizeof($best_offer)) / 2); $i++)
		$this->renderPartial('/banner/index', array('banner' => $best_offer[$i * 2 + 1]));
	?>

</section>