<?php
/**
 * Created by PhpStorm.
 * User: kolya_ya
 * Date: 28.01.2018
 * Time: 20:20
 */
/**
 * @var $schools array content for schools list
 * @var $page object static content for top block
 * @var $pagerSettings array
 * @var $banners array banners for right column
**/

  Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');
  Yii::app()->clientScript->registerMetaTag(Lang::local($page->keywords), 'keywords');

?>

            <article class="main-content--border">
                <h2 class="inner-page__header"><?=Lang::local($page->name)?></h2>
                <?= Lang::local($page->content); ?>
            </article>

<? if (is_array($schools)):?>

            <div class="article-list">
                    <? if ($schools): ?>

                        <div class="article-list__paginator">
                            <?$this->widget('CLinkPager', $pagerSettings )?>
<!--                            --><?//=D::dump($pagerSettings)?>
                        </div>

                        <? foreach ($schools as $school)
                            $this->renderPartial('_schoolListItem', array('school' => $school));
                        ?>

                        <div class="article-list__paginator">
                            <?$this->widget('CLinkPager', $pagerSettings )?>
                        </div>

                    <? else: ?>

                    <article  class="main-content--border">
                        <h3><?=Yii::t('app', 'no_results')?></h3>
                    </article>

                    <?php endif; ?>

            </div>

<? endif; ?>