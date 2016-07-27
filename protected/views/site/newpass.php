<div class="grid_12">
	<div class="inner-block">
		<div class="bg-white pad-1 top">
			<div class="form-title"><?=Yii::t('auth', 'recover')?></div>
			
			<? if (!empty($message)): ?>
			<div class="login-text"><?=$message?></div>
			<? else: ?>
			<div class="login-text"><?=Yii::t('auth', 'email_login')?></div>
			<? endif ?>

			<div class="form">
				<form id="login-form" action="/recover" method="post">
					<input type="hidden" name="user" value="<?=$user?>" />
					<input type="hidden" name="key" value="<?=$key?>" />
					<div class="label">
						<label for="login"><?=Yii::t('auth', 'password')?></label>
						<input type="password" name="password1" id="password1">
					</div>
					<div class="label">
						<label for="email"><?=Yii::t('auth', 'password_confirm')?></label>
						<input type="password" name="password2" id="password2">
					</div>
					<div class="label buttons">
						<?php echo CHtml::submitButton(Yii::t('auth', 'recover_btn')); ?>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
