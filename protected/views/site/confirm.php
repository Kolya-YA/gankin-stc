<?php
/**
 * @var boolean $result The result of confirmation
 * @var string $returnUrl The return URL form this confirmation form
 * */
?>

<div class="small-form">

    <h2 class="form-title"><?= Yii::t('auth', 'confirmation') ?></h2>
    <? if ($result): ?>
        <p class="login-text"><?= Yii::t('auth', 'confirm_success') ?></p>

        <script type="text/javascript">
            window.setTimeout(() => window.location.href = '<?= $returnUrl ?>', 8000);
        </script>

    <? else: ?>
        <p class="login-text"><?= Yii::t('auth', 'confirm_fail') ?></p>
    <? endif ?>

</div>