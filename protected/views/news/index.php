<?php
/**
* @var $this NewsController
* @var $page object content for render announce in head of content part
* @var $results array news content
* @var $pagerSettings array settings for paginator
 */

Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');
?>


    <article class="main-content--border">
<!--        <h2>Tarifa kitesurfing and windsurfing news</h2>-->
        <h2 class="inner-page__header"><?=Lang::local($page->name)?></h2>
        <?= Lang::local($page->content); ?>
    </article>

<? if (is_array($results)):?>

    <div class="article-list">
        <? if ($results): ?>

            <div class="article-list__paginator">
                <?$this->widget('CLinkPager', $pagerSettings )?>
            </div>

            <? foreach ($results as $result)
                $this->renderPartial('_viewItem', array('result' => $result));
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