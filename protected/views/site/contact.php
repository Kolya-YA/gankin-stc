<?php
$this->pageTitle = Lang::local($contacts->name) . ' | ' . Yii::app()->name;
Yii::app()->clientScript->registerMetaTag(Lang::local($contacts->short_description), 'description');
Yii::app()->clientScript->registerMetaTag(Lang::local($contacts->keywords), 'keywords');
?>

<div class="inner-page">
    <div class="inner-page__internal-wrapper">

        <div class="inner-page__form">
            <div class="contact-form">
                <h2 class="contact-form__title">Contact form</h2>

                <?php if (Yii::app()->user->hasFlash('form-success-1')): ?>

                    <div class="contact-form__success">
                        <p><?= Yii::app()->user->getFlash('form-success-1'); ?></p>
                        <p><strong><?= Yii::app()->user->getFlash('form-success-2'); ?></strong></p>
                    </div>

                <?php else: ?>

                    <?php
                    $form = $this->beginWidget('CActiveForm', [
                        'id' => 'form',
                        'enableClientValidation' => false,
                    ]);
                    ?>

<!--                    --><?//= $form->errorSummary($model); ?>

                    <?= $form->labelEx($model, 'name'); ?>
                    <?= $form->textField($model, 'name', [
                            'placeholder' => Yii::t('form', 'name'),
                            'maxlength' => 65,
                    ]); ?>
                    <?= $form->error($model, 'name'); ?>

                    <?= $form->labelEx($model, 'email'); ?>
                    <?= $form->emailField($model, 'email', ['placeholder' => 'E-mail']); ?>
                    <?= $form->error($model, 'email'); ?>

                    <?= $form->labelEx($model, 'body'); ?>
                    <?= $form->textArea($model, 'body', [
                            'placeholder' => Yii::t('form', 'message'),
                            'maxlength' => 1024,
                    ]); ?>
                    <?= $form->error($model, 'body'); ?>

                    <div class="btns">
                        <button class="button"><?= Yii::t('form', 'submit') ?></button>
                    </div>

                    <?php $this->endWidget(); ?>
                <? endif ?>
            </div>
        </div>

        <article class="inner-page__page-content">
            <h2><?= Lang::local($contacts->name) ?></h2>
            <?= Lang::local($contacts->content) ?>
        </article>

    </div>
</div>