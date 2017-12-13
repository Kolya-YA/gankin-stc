<?php
	$this->pageTitle = Lang::local($page->name) . ' | ' . Yii::app()->name;
  Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');  
  Yii::app()->clientScript->registerMetaTag(Lang::local($page->keywords), 'keywords');  
?>

<section id="content" class="main-content">

	<div class="main-content__wrapper">

		<div class="home-page-top">

			<div class="home-page-top__left home-page-top__left--wide">

				<div class="about-us">
						<h2><?=Yii::t('app', 'about')?></h2>
						<?=Lang::local($about->content)?>
				</div>

			</div>
			
			<div class="home-page-top__right">
					<?=  $this->renderPartial('/blocks/duolink') ?>
			</div>

		</div>

		<div class="home-page-bottom">

			<div class="home-page-bottom__left">
					<?=$this->renderPartial('/news/lastnews', array('news' => $news))?>
			</div>

			<div class="home-page-bottom__right home-page-bottom__right--wide">

				<h2><?=Yii::t('app', 'bestoffer')?> <!--<a href="#" class="link"><?=Yii::t('app', 'seeall')?></a>--></h2>
				<div class="box-1">
					<ul>
					<? for ($i = 0; $i < (int)((sizeof($best_offer) + 1) / 2); $i++)
						$this->renderPartial('/banner/index', array('banner' => $best_offer[$i * 2]));
					?>
					</ul>
					<ul class="last">
					<? for ($i = 0; $i < (int)((sizeof($best_offer)) / 2); $i++)
						$this->renderPartial('/banner/index', array('banner' => $best_offer[$i * 2 + 1]));
					?>
					</ul>
				</div>

			</div>

		</div>

	</div>  
</section>