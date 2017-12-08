<?php 
    Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');  
    Yii::app()->clientScript->registerMetaTag(Lang::local($page->keywords), 'keywords');
?>

<div class="inner-page">
	<article class="inner-page__page-content">
		<h2 class="inner-page__header"><?=Lang::local($page->name)?></h2>
		<?=Lang::local($page->content)?>
	</article>
</div>