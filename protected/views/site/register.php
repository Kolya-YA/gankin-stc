<div class="small-form">
    <h2 class="form-title"><?= Yii::t('auth', 'registration') ?></h2>


    <?php if ($message = Yii::app()->user->getFlash('confirmation-email')): ?>

        <div class="small-form__success">
            <p><?= $message ?></p>
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

        <?= $form->labelEx($model, 'login'); ?>
        <?= $form->textField($model, 'login'); ?>
        <?= $form->error($model, 'login'); ?>

        <?= $form->labelEx($model, 'email'); ?>
        <?= $form->emailField($model, 'email'); ?>
        <?= $form->error($model, 'email'); ?>

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