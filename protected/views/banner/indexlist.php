<section class="article-list">

	<?
	for ($i = 0; $i < (int)((sizeof($best_offer) + 1) / 2); $i++)
		$this->renderPartial('/banner/index', array('banner' => $best_offer[$i * 2], 'pic_width' => 251, 'pic_height' => 167));

	for ($i = 0; $i < (int)((sizeof($best_offer)) / 2); $i++)
		$this->renderPartial('/banner/index', array('banner' => $best_offer[$i * 2 + 1], 'pic_width' => 251, 'pic_height' => 167));
	?>

</section>

<!--<a href="#" class="link">--><?//=Yii::t('app', 'seeall')?><!--</a>-->