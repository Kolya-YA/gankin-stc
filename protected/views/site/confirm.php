	<div class="inner-block">

			<div class="form-title"><?=Yii::t('auth', 'confirmation')?></div>
			<? if ($result): ?>
			<div class="login-text"><?=Yii::t('auth', 'confirm_success')?></div>

			<script type="text/javascript">  
			window.setTimeout(function(){
				window.location.href = '<?= $returnUrl ?>';
			}, 9000);
			</script>
			
			<? else: ?>
			<div class="login-text"><?=Yii::t('auth', 'confirm_fail')?></div>
			<? endif ?>

    </div>