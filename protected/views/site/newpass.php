<?php
/**
 * @var object $model data for form
 */


?>

<div class="small-form">

    <h2 class="form-title"><?= Yii::t('auth', 'recover') ?></h2>

    <?php

    if ($flash = Yii::app()->user->getFlash('code_expired')): ?>

        <div class="small-form__success">
            <p><i><?= $flash; ?></i></p>
        </div>

    <?php else: ?>

    <?php $form = $this->beginWidget('CActiveForm', [ //TODO add CSS rules for error status
        'id' => 'login-form',
        'enableClientValidation' => false,
        'clientOptions' => [
            'validateOnSubmit' => true,
        ],
    ]); ?>
    <?= $form->errorSummary($model); ?>

<!--    --><?//= $form->hiddenField($model, 'id'); ?>
<!--    --><?//= $form->hiddenField($model, 'key'); ?>

    <?= $form->labelEx($model, 'password1'); ?>
    <?= $form->passwordField($model, 'password1'); ?>
    <?= $form->error($model, 'password1'); ?>

    <?= $form->labelEx($model, 'password2'); ?>
    <?= $form->passwordField($model, 'password2'); ?>
    <?= $form->error($model, 'password2'); ?>

    <button class="button"><?= Yii::t('auth', 'register_btn'); ?></button>

    <?php $this->endWidget(); ?>

    <? endif; ?>
    </div>
</div>
