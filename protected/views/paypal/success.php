<? $this->pageTitle = Yii::app()->name . ' - ' . Lang::local($page->name)?>
<div class="grid_12">
	<div class="inner-block">
		<h2 class="h2-border p3"><?=Lang::local($page->name)?></h2>
		<?=Lang::local($page->content)?>
		
		<table class="order-details">
			<? foreach ($transaction->getDetailsArray() as $d): ?>
			<tr><td><?=Yii::t('app', ucfirst($d[0]))?></td><td><?=ucfirst($d[1])?></td></tr>
			<? endforeach ?>
		</table>
		
		<? if (!$this->print):?>
		<a href="?print" class="button" target="_blank"><?=Yii::t('app', 'Print this page')?></a>
		<? endif ?>
		
		<? $this->renderPartial('/banner/right', array('banners' => $banners)) ?>
		<? foreach ($banners as $banner): ?>
		<? endforeach?>
	</div>
</div>
