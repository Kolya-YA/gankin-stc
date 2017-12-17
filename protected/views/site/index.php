<?php
	$this->pageTitle = Lang::local($page->name) . ' | ' . Yii::app()->name;
  Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');  
  Yii::app()->clientScript->registerMetaTag(Lang::local($page->keywords), 'keywords');  
?>

<section id="content" class="main-content">

	<div class="main-content__wrapper">

		<div class="home-page-top">

			<div class="home-page-top__left">
				<?=  $this->renderPartial('/blocks/duolink') ?>				
			</div>
			
			<div class="home-page-top__right  home-page-top__right--wide">
				<div class="about-us">
						<h2><?=Yii::t('app', 'about')?></h2>
						<?=Lang::local($about->content)?>
				</div>
			</div>

		</div>

		<div class="home-page-bottom">

			<div class="home-page-bottom__left home-page-bottom__left--wide home-page-bottom__left--no-border">
				<?=$this->renderPartial('/banner/indexlist', array('best_offer' => $best_offer))?>
			</div>
				
			<div class="home-page-bottom__right">
				<?=$this->renderPartial('/news/lastnews', array('news' => $news))?>
			</div>

		</div>

	</div>  
</section>