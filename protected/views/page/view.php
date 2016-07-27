<?php 
    Yii::app()->clientScript->registerMetaTag(Lang::local($page->short_description), 'description');  
    Yii::app()->clientScript->registerMetaTag(Lang::local($page->keywords), 'keywords');  

?>

<div class="grid_12">
	<div class="inner-block">
		<h2 class="h2-border p3"><?=Lang::local($page->name)?></h2>
		<?=Lang::local($page->content)?>
	</div>
</div>
