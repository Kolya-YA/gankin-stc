<div class="grid_12" id="order-page">
	<div class="inner-block school">
		<h2 class="h2-border p3"><?=Lang::local($school->name)?></h2>
		<img class="school-photo" src="<?=AutoThumb::url('/media/'.$school->picture, 200, 200)?>" />
		<?=Lang::local($school->description)?>
		
		<?php //copy-paste from school/view ?>
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
		
		<?php //copy-paste from school/view ?>
		
		<div id="order">
			<?=$type == 'equipment' ? Yii::t('app', 'renteq') : Yii::t('app', 'order_course') ?>
			<table class="order-details">
			<? foreach ($details as $d): ?>
			<tr><td><?=$d['name']?></td><td><?=$d['value']?></td></tr>
			<? endforeach ?>
			<tr class="total" data-price="<?=$school->price?>"><td><?=Yii::t('app', 'price')?></td><td class="value"><?=$model->percent ? $school->price * .2 : $school->price?>€</td></tr>
			</table>
			
			<div class="order-form left">
			<?php $form=$this->beginWidget('application.widgets.ActiveForm', array(
				'id'=>'form2',
				'enableAjaxValidation'=>false,
				'action' => $_SERVER['REQUEST_URI'].'#order',
// 				'htmlOptions' => array('class' => 'form-style-2'),
			)); ?>
				<h2><?=Yii::t('app', 'Pay with credit card')?></h2>
<!--
				<div class="row">
					<?=$form->label($model, 'first_name')?>
					<?=$form->textField($model, 'first_name')?>
					<?=$form->error($model, 'first_name')?>
				</div>
				<div class="row">
					<?=$form->label($model, 'last_name')?>
					<?=$form->textField($model, 'last_name')?>
					<?=$form->error($model, 'last_name')?>
				</div>
				<div class="row">
					<?=$form->label($model, 'card_number')?>
					<?=$form->textField($model, 'card_number')?>
					<?=$form->error($model, 'card_number')?>
				</div>
				<div class="cards">
					<img src="/images/logo_ccMC.gif" title="MasterCard" />
					<img src="/images/logo_ccVisa.gif" title="Visa" />
					<img src="/images/logo_ccDiscover.gif" title="Discover"/>
					<img src="/images/logo_ccAmex.gif" title="American Express"/>
				</div>
				
				<div class="form-style-2">
					<div class="row">
						<?=$form->label($model, 'expiration_month')?>
						<span>
						<?=$form->dropDownList($model, 'expiration_month', OrderForm::months())?>
						</span>
						<?=$form->error($model, 'expiration_month')?>
					</div>
					<div class="row">
						<?=$form->label($model, 'expiration_year')?>
						<span>
						<?=$form->dropDownList($model, 'expiration_year', OrderForm::years())?>
						</span>
						<?=$form->error($model, 'expiration_year')?>
					</div>
				</div>
				<div class="row">
					<?=$form->label($model, 'cv_code')?>
					<?=$form->textField($model, 'cv_code')?>
					<?=$form->error($model, 'cv_code')?>
				</div>
-->

				<div class="row">
					<?=$form->label($model, 'percent')?>
					<?=$form->checkBox($model, 'percent')?>
					<?=$form->error($model, 'percent')?>
				</div>
				<div class="row">
					<?=$form->label($model, 'accept')?>
					<?=$form->checkBox($model, 'accept')?>
					<?=$form->error($model, 'accept')?>
				</div>
				<?php if (Yii::app()->user->isGuest):?>
				<a href="/register" class="button"><?=Yii::t('app', 'order')?></a>
				<?php else: ?>
				<a href="#"  onClick="document.getElementById('form2').submit();return false;" class="button"><?=Yii::t('app', 'order')?></a>
				<? endif ?>
			<?php $this->endWidget(); ?>
			</div>
			
			<div class="order-form right">
			<?php $form=$this->beginWidget('application.widgets.ActiveForm', array(
				'id'=>'form3',
				'enableAjaxValidation'=>false,
				'action' => $_SERVER['REQUEST_URI'].'#order',
			)); ?>
				<input type="hidden" value="1" name="paypal" />
				<h2><?=Yii::t('app', 'Pay with PayPal')?> <img class="paypal-logo" src="/images/paypal_logo_small.gif" /></h2> 
				<div class="row">
					<label for="paypal_percent"><?=Yii::t('app', 'Pay 20%')?> *</label>
					<input type="checkbox" value="1" id="paypal_percent" name="percent" <?= $_SERVER['REQUEST_METHOD'] == 'GET' ? 'checked' : false?>>
				</div>
				
				<div class="row">
					<label for="paypal_accept"><?=Yii::t('app', 'accept')?></label>
					<input type="checkbox" value="1" id="paypal_accept">
					<div class="errorMessage" style="display:none"><?=Yii::t('app', 'Read and accept terms & conditions')?></div>
				</div>
				
				<?php if (Yii::app()->user->isGuest):?>
				<?php $this->endWidget(); ?>
				<a href="/register" class="button" onclick="javascript:void(0)"><?=Yii::t('app', 'order')?></a>
				<?php else: ?>
				<a href="#" class="button"><?=Yii::t('app', 'order')?></a>
				<?php $this->endWidget(); ?>
				<?php endif ?>
			
			</div>
			
<!--			<a href="/school/order?id=<?=$school->id?>&amp;filter=<?=$filter?>&amp;confirm=1" class="button"><?=Yii::t('app', 'order')?></a>
			<a href="/school/order?id=<?=$school->id?>&amp;filter=<?=$filter?>&amp;confirm=1&amp;percent=1" class="button"><?=Yii::t('app', 'pay_percent')?> *</a>-->
			
			<div class="clear"></div>
			<div class="comment"><span>*</span> <?=Yii::t('app', 'percent_comment')?></div>
			
			
		</div>
		<?= $this->renderPartial('/banner/right', array('banners' => $banners)) ?>
	</div>
</div>