<div class="grid_12">
	<div class="inner-block">
		<div class="bg-white pad-1 top">
			<div class="form-title"><?=Yii::t('auth', 'confirmation')?></div>
			<? if ($result): ?>
			<div class="login-text"><?=Yii::t('auth', 'confirm_success')?></div>
			<script type="text/javascript">  
			window.setTimeout(function(){
				window.location.href = '<?= $returnUrl ?>';
			}, 5000);
			</script>
			
			<? else: ?>
			<div class="login-text"><?=Yii::t('auth', 'confirm_fail')?></div>
			<? endif ?>
		</div>
	</div>
</div>