<?php
/**
 * Created by PhpStorm.
 * User: kolya_ya
 * Date: 05.02.2018
 * Time: 15:49
 */

/**
* @var $content string rendered content content for left column
* @var $this Controller
* @var $this->banners array banners for right column
**/

?>

<?php $this->beginContent('//layouts/inner'); ?>

<div class="main-content__wrapper">
    <div class="main-content__horizontal-block">

        <div class="main-content__left-block main-content__left-block--wide">
            <?=$content; ?>
        </div>
        <? if (isset($this->banners)) : ?>
        <div class="main-content__right-block">
            <? if ($this->banners) : ?>
	        <? $this->renderPartial('/banner/left', array('banners' => $this->banners))?>
            <? else: ?>
            <article  class="main-content--border">
                <h3><?=Yii::t('app', 'no_results')?></h3>
            </article>
            <? endif; ?>
        </div>
        <? endif; ?>

    </div>
</div>

<?php $this->endContent(); ?>