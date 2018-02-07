<?php
/**
 * Created by PhpStorm.
 * User: kolya_ya
 * Date: 06.02.2018
 * Time: 19:58
 */
?>

<footer class="page-footer">

    <div class="page-footer__top">
        <div class="page-footer__wrapper">
            <div class="page-footer__nav">
                <a href="/rental"><?= Yii::t('app', 'rental_policies') ?></a>
                <a href="/privacy"><?= Yii::t('app', 'privacy_policy') ?></a>
                <a href="/faq"><?= Yii::t('app', 'faq') ?></a>
                <a href="/partner"><?= Yii::t('app', 'become_partner') ?></a>
                <a href="/impressum"><?= Yii::t('app', 'impressum') ?></a>
                <? if (!Yii::app()->user->isGuest): ?>
                    <a href="/userpanel"><?= Yii::t('menu', 'userpanel') ?></a>
                <? endif ?>
            </div>
        </div>
    </div>

    <div class="page-footer__bottom">
        <div class="page-footer__wrapper">
            <div class="page-footer__contacts">
                <div class="copyright"><?= $_SERVER['HTTP_HOST'] ?> &copy; <?= date('Y') ?></div>
                <div class="address"><?= Yii::t('app', 'address') ?></div>
                <div class="phone"><?= Yii::t('app', 'phone') ?></div>
            </div>
        </div>
    </div>

</footer>