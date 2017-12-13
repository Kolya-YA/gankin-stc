<?php
	$this->pageTitle = Lang::local($page->name);    if ($this->pageTitle == 'Check all kite, windsurf, surf schools prices in Tarifa, Choose right one') {    $this->pageTitle = 'surf-tarifa | Check all kite, windsurf, surf schools prices in Tarifa';  }
    Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');  
    Yii::app()->clientScript->registerMetaTag(Lang::local($page->keywords), 'keywords');  
?>

<section id="content" class="main-content">

	<div class="main-content__wrapper">

		<div class="home-page-top">

			<div class="home-page-top__banner">
				<div class="inner-block">
					<?php //	<div class="under-construction">Site is under construction</div>?>
					<div id="slide" class="camera_wrap camera_azure_skin">  
					<? foreach ($gallery as $g): ?>
						<div data-src="<?=AutoThumb::url('/media/'.$g->picture, 620, 347)?>">
							<div class="banner camera_caption fadeFromBottom">
								<p><!--<strong><?=Lang::local($g->name)?></strong>-->
								<!-- <a href="/school/<?=$g->id?>"></a> -->
								<?=Lang::local(strip_tags($g->description))?>
								</p>
							</div>
						</div>
					<? endforeach ?>
					</div>
				</div>
			</div>

			<div class="home-page-top__search">				
				<div class="form-title">
					<?=Yii::t('app', 'searchsurf')?>
				</div>
				<img src="/images/surfer.jpg" class="side-ico" alt="">
				<form id="form1" class="form-style" method="post">
					<label>
						<span><?=Yii::t('app', 'location')?></span>
							<select class="select1" name="area">
								<option value=""><?=Yii::t('app', 'allarea')?></option>
								<? foreach (Location::getLocations() as $k => $v):?>
								<option value="<?=$k?>"><?=$v?></option>
								<? endforeach ?>
							</select>
					</label>
					<a href="/equipment" class="button" id="rent-btn"><?=Yii::t('app', 'renteq')?></a>
					<a href="/school" class="button" id="surf-btn"><?=Yii::t('app', 'findsurf')?></a>
				</form>				
			</div>

		</div>

		<div class="home-page-bottom">

			<div class="home-page-bottom__about">
				<div class="about-us">
					<h2><?=Yii::t('app', 'about')?></h2>
					<?=Lang::local($about->content)?>
				</div>
				<div class="lastest-news">
					<?=$this->renderPartial('/news/lastnews', array('news' => $news))?>
				</div>
			</div>

			<div class="home-page-bottom__offer">
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

<script src="/js/camera.js"></script>
<script>
	document.addEventListener('DOMContentLoaded',function() {
	document.querySelector('select[name="area"]').onchange=changeArea;
},false);

function changeArea(event) {
	let areaNum = event.target.value;
  document.getElementById('rent-btn').href = '/equipment?area=' + areaNum;
  document.getElementById('surf-btn').href = '/school?area=' + areaNum;
}
</script>