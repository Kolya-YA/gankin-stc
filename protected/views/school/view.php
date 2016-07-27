<? $this->pageTitle = Yii::app()->name . ' - ' . Lang::local($school->name)?>
<?php 
    Yii::app()->clientScript->registerMetaTag(Lang::local($school->short_description), 'description');  
    Yii::app()->clientScript->registerMetaTag(Lang::local($school->short_description), 'keywords');  
    Yii::app()->clientScript->registerMetaTag('index,nofollow', 'robots');  
?>
<div class="grid_12">
	<div class="inner-block school">
		<h2 class="h2-border p3"><?=Lang::local($school->name)?></h2>
		<img class="school-photo" src="<?=AutoThumb::url('/media/'.$school->picture, 200, 200)?>" />
		<?=Lang::local($school->description)?>
		
		<? if ($school->latitude && $school->longitude): ?>
		<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;key=AIzaSyA7Bqzv6aUAyMfmQoP6NO7QQVRSFvWeHtU" type="text/javascript"></script>
		<div id="map-canvas" style="width: 400px; height: 300px"></div> 

		<script type="text/javascript"> 
			function initialize() {
				var location = new google.maps.LatLng(<?= "{$school->latitude}, {$school->longitude}" ?>);
				var mapOptions = {
					center: location,
					zoom: 15,
					mapTypeId: google.maps.MapTypeId.HYBRID
				};
				var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
				var marker = new google.maps.Marker({
					position: location,
					title: "<?=Lang::local($school->name)?>"
				});

				marker.setMap(map);
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script> 
		<? endif ?>
	</div>
</div>
