<?php
/**
 * Created by PhpStorm.
 * User: kolya_ya
 * Date: 28.01.2018
 * Time: 20:20
 */

  $this->pageTitle = Lang::local($page->name) . ' | ' . Yii::app()->name;
  Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');
  Yii::app()->clientScript->registerMetaTag(Lang::local($page->keywords), 'keywords');

?>
<div class="main-content__wrapper">
    <div class="main-content__horizontal-block">
        <div class="main-content__left-block main-content__left-block--wide">

            <article class="main-content--border">
                <h2 class="inner-page__header"><?=Lang::local($page->name)?></h2>
                <?= Lang::local($page->content); ?>
            </article>

<? if (is_array($schools)):?>

            <div class="schools-list">
                    <? if ($schools): ?>

                        <div class="schools-list__paginator">
                            <?$this->widget('CLinkPager', $pagerSettings )?>
<!--                            --><?//=D::dump($pagerSettings)?>
                        </div>

                        <? foreach ($schools as $school)
                            $this->renderPartial('_schoolListItem', array('school' => $school));
                        ?>

                        <div class="schools-list__paginator">
                            <?$this->widget('CLinkPager', $pagerSettings )?>
                        </div>

                    <? else: ?>

                    <article  class="main-content--border">
                        <h3><?=Yii::t('app', 'no_results')?></h3>
                    </article>

                    <?php endif; ?>

            </div>

<? endif; ?>

        </div>

        <div class="main-content__right-block">
	        <? $this->renderPartial('/banner/left', array('banners' => $banners))?>
        </div>

    </div>

</div>