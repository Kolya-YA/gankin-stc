<?php 
    Yii::app()->clientScript->registerMetaTag(Lang::local($model->description), 'description');  
    Yii::app()->clientScript->registerMetaTag(Lang::local($model->keywords), 'keywords');  

?>
<div class="grid_12">
	<div class="inner-block school">
		<h2 class="h2-border p3"><?=Lang::local($model->name)?></h2>
		<img class="school-photo" src="<?=AutoThumb::url('/media/'.$model->picture, 200, 200)?>" />
		<?=Lang::local($model->content)?>
	</div>
</div>

