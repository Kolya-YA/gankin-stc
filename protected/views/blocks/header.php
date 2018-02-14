<?php
/**
 * Created by PhpStorm.
 * User: kolya_ya
 * Date: 06.02.2018
 * Time: 20:26
 */

?>

<div class="page-header__holder"></div>

<header class="page-header page-header--closed">

    <button class="toggle-menu" type="button">
        <span class="toggle-menu__burger"></span>Menu
    </button>

    <div class="page-header__wrapper">

        <div class="page-header__top">

            <?= $this->renderPartial('/blocks/lang', ['lang' => Yii::app()->language]) ?>

            <? $this->widget('application.widgets.Menu', [
                'items' => [
                    [
                        'label' => Yii::t('auth', 'logout') . ' (' . Yii::app()->user->name . ')',
                        'url' => $this->createUrl('site/logout'),
                        'visible' => !Yii::app()->user->isGuest,
                        'itemOptions' => ['class' => 'user-menu__logout']
                    ],
                    [
                        'label' => Yii::t('menu', 'register'),
                        'url' => $this->createUrl('site/register'),
                        'visible' => Yii::app()->user->isGuest,
                        'itemOptions' => ['class' => 'user-menu__register']
                    ],
                    [
                        'label' => Yii::t('menu', 'login'),
//                        'url' => '/login',
                        'url' => Yii::app()->user->loginUrl,
                        'visible' => Yii::app()->user->isGuest,
                        'itemOptions' => ['class' => 'user-menu__login']
                    ]
                ],
                'activeCssClass' => 'current',
                'htmlOptions' => ['class' => 'user-menu'],
                'activateItems' => true,
                'encodeLabel' => false,
            ]); ?>

        </div>

        <div class="top-logo page-header__logo">
            <a class="top-logo__link" href="/">
                <img class='top-logo__logo' src="../images/logo.png" alt="surf-Tarifa.com logo" width="250">
                <h1 class='top-logo__name'>
                    <?= Yii::t('app', 'header_h1') ?>
                </h1>
            </a>
            <!-- <a class="top-logo__phone" href="tel:<?= Yii::t('app', 'phone') ?>"><?= Yii::t('app', 'phone') ?></a> -->
        </div>

        <nav class="page-header__main-nav">
            <? $this->widget('application.widgets.Menu', [
                'items' => [
                    [
                        'label' => Yii::t('menu', 'home'),
//                        'url' => '/'
                        'url' => Yii::app()->getHomeUrl(),
                    ],
                    [
                        'label' => Yii::t('menu', 'aboutTarifa'),
                        'url' => '/tarifa'
                    ],
                    [
                        'label' => Yii::t('menu', 'schools'),
                        'url' => '/kite_schools_in_tarifa'
                    ],
                    [
                        'label' => Yii::t('menu', 'school'),
                        'url' => '/school'
                    ],
                    [
                        'label' => Yii::t('menu', 'equipment'),
                        'url' => '/equipment'
                    ],
//						array('label'=>Yii::t('menu', 'faq'),			'url'=>'/faq'),
                    [
                        'label' => Yii::t('menu', 'contacts'),
                        'url' => $this->createUrl('site/contacts')
                    ]
                ],
                'activeCssClass' => 'current',
                'htmlOptions' => ['class' => 'main-nav-list'],
                'activateItems' => true,
                'encodeLabel' => false,
            ]); ?>
        </nav>

    </div>

</header>