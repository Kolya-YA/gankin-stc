<? $this->pageTitle = Lang::local($school->name) . ' | ' . Yii::app()->name?>
<?php 
    Yii::app()->clientScript->registerMetaTag(Lang::local($school->short_description), 'description');  
    Yii::app()->clientScript->registerMetaTag(Lang::local($school->short_description), 'keywords');  
    Yii::app()->clientScript->registerMetaTag('index,nofollow', 'robots');  
?>
<div class="inner-page">
	<article class="inner-page__page-content">

		<h2 class="inner-page__header"><?=Lang::local($school->name)?></h2>
		<img class="school-photo" src="<?=AutoThumb::url('/media/'.$school->picture, 200, 200)?>" />
		<?=Lang::local($school->description)?>
		
		<? if ($school->latitude && $school->longitude): ?>
		
		<div class="inner-page__map" id="map"></div> 
		
		<script type="text/javascript"> 
      function initMap() {
				let location = new google.maps.LatLng(<?= "{$school->latitude}, {$school->longitude}" ?>);
        let map = new google.maps.Map(document.getElementById('map'), {
          center: location,
          zoom: 15
        });
				let marker = new google.maps.Marker({
          position: location,
          map: map
        });
      }
		</script> 
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfSYVUXeUIWKN63q3tZQM7P2oiMmRr1xw&callback=initMap" async defer></script>
		
		<? endif ?>

	</article>
</div>