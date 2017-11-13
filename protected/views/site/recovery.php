<div class="small-form">
	<div class="form-title"><?=Yii::t('auth', 'recover')?></div>
	
	<? if ($message): ?>
	<div class="login-text"><?=$message?></div>
	<? else: ?>
	<div class="login-text"><?=Yii::t('auth', 'email_login')?></div>
	<? endif ?>

	<div class="form">
		<form id="login-form" action="/recovery" method="post">
			<div class="label">
				<label for="login"><?=Yii::t('auth', 'username')?></label>
				<input name="login" id="login" type="text">
			</div>
			<div class="label">
				<label for="email">E-mail</label>
				<input name="email" id="email" type="text">
			</div>
			<div class="label buttons">
				<?php echo CHtml::submitButton(Yii::t('auth', 'recover_btn')); ?>
			</div>

		</form>
	</div>
</div>
