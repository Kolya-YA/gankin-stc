<?php 
    Yii::app()->clientScript->registerMetaTag(Lang::local($news->description), 'description');  
    Yii::app()->clientScript->registerMetaTag(Lang::local($news->keywords), 'keywords');  

?>
<div class="inner-page">
	<div class="inner-page__page-content">
		<h2 class="inner-page__header"><?=Lang::local($news->name)?></h2>
		<time class="inner-page__date" datetime="<?=date('Y-m-d', strtotime($news->created))?>"><?=date('d.m.Y', strtotime($news->created))?></time>		
		<?=Lang::local($news->content)?>

<?php $pagelink ='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; $pd=json_decode($news->description); $pagedescription=$pd->{'en'};?>
				<div class="likes-block">			<a onclick="window.open('http://www.facebook.com/sharer.php?u=<?=$pagelink?>', 'facebook', 'width=626, height=436'); return false;" rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?=$pagelink;  ?>" class="like l-fb">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>				<a onclick="window.open('http://vkontakte.ru/share.php?url=<?=$pagelink; ?>&description=<?=urlencode($pagedescription);?>', 'vkontakte', 'width=626, height=436'); return false;" href="http://vkontakte.ru/share.php?url=<?=$pagelink;  ?>&description=<?=urlencode($pagedescription);?>" rel="nofollow" class="like l-vk">	
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>		

<a onclick="window.open('https://twitter.com/share?url=<?=$pagelink; ?>&text=<?=urlencode($pagedescription);?>', 'twitter', 'width=626, height=436'); return false;" rel="nofollow" href="https://twitter.com/share?url=<?=$pagelink; ?>&text=<?=urlencode($pagedescription);?>" class="like l-tw">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>				

				<!--	<a onclick="window.open('http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=<?=$pagelink;  ?>', 'odkl', 'width=626, height=436'); return false;" rel="nofollow" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=<?=$pagelink; ?>" class="like l-ok">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>			-->		<a onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=ru&url=<?=$pagelink; ?>', 'gplusshare', 'width=626, height=436'); return false;" href="https://plusone.google.com/_/+1/confirm?hl=ru&url=<?=$pagelink; ?>" rel="nofollow" class="like l-gp">
					<i class="l-ico"></i>
					<span class="l-count"></span>
					</a>				</div>
				</div>
</div></div><div class="clear"></div>

	</div>
</div>