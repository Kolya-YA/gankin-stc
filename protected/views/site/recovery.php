<?php
/**
 * @var object $model data for form
 */
?>

<div class="small-form">
    <h2 class="form-title"><?= Yii::t('auth', 'recover') ?></h2>

    <?php if (Yii::app()->user->hasFlash('recovery_sent')): ?>

        <div class="small-form__success">
            <p><?= Yii::app()->user->getFlash('recovery_sent'); ?></p>
        </div>

    <?php else: ?>

        <?php $form = $this->beginWidget('CActiveForm', [ //TODO add CSS rules for error status
            'id' => 'recovery-form',
            'enableClientValidation' => false,
            'clientOptions' => [
                'validateOnSubmit' => true,
            ],
        ]); ?>


        <?= $form->errorSummary($model); ?>


        <?= $form->labelEx($model, 'email'); ?>
        <?= $form->textField($model, 'email'); ?>
        <?= $form->error($model, 'email'); ?>

        <button class="button"><?= Yii::t('auth', 'recover_btn'); ?></button>

        <?php $this->endWidget(); ?>
    <? endif; ?>

</div>