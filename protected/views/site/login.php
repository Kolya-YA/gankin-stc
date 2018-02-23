<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' | Login';
$this->breadcrumbs = [
    'Login',
];

?>
<div class="small-form">
    <h2 class="form-title"><?= Yii::t('auth', 'login') ?></h2>

    <?php $form = $this->beginWidget('CActiveForm', [
        'id' => 'login-form',
//        'enableClientValidation' => false,
//        'clientOptions' => [
//            'validateOnSubmit' => true,
//        ],
    ]); ?>

    <?= $form->labelEx($model, 'username'); ?>
    <?= $form->textField($model, 'username'); ?>
    <?= $form->error($model, 'username'); ?>

    <?= $form->labelEx($model, 'password'); ?>
    <?= $form->passwordField($model, 'password'); ?>
    <?= $form->error($model, 'password'); ?>

    <?= $form->checkBox($model, 'rememberMe'); ?>
    <?= $form->label($model, 'rememberMe', ['class' => 'wide']); ?>
    <?= $form->error($model, 'rememberMe'); ?>

    <div class="recovery">
        <a href="/recovery"><?= Yii::t('auth', 'recover') ?></a>
    </div>

    <button class="button"><?= Yii::t('auth', 'login_btn'); ?></button>

    <?php $this->endWidget(); ?>

    <div class="register">
        <p class="login-text"><?= Yii::t('auth', 'login_text') ?></p>
        <p class="register-text"><?= Yii::t('auth', 'new_user') ?></p>
        <a href="/register" class="button register-link"><?= Yii::t('auth', 'register') ?></a>
    </div>

</div>