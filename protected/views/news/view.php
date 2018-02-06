<?php
/**
* @var $news object news content
*/
    Yii::app()->clientScript->registerMetaTag(Lang::local($news->description), 'description');
    Yii::app()->clientScript->registerMetaTag(Lang::local($news->keywords), 'keywords');  

//    $pageLink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//    $pd  = json_decode($news->description);
//    $pageDescription = $pd->{'en'};
    $this->params['pageLink'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//    $this->params['pageDescription']  = json_decode($news->description)->{'en'};
?>

<div class="inner-page">
	<div class="inner-page__page-content">
		<h2 class="inner-page__header"><?=Lang::local($news->name)?></h2>
		<time class="inner-page__date" datetime="<?=date('Y-m-d', strtotime($news->created))?>"><?=date('d.m.Y', strtotime($news->created))?></time>
		<?=Lang::local($news->content)?>

        <?=  $this->renderPartial('/blocks/likesBlock') ?>

    </div>
</div>