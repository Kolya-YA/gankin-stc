<div id="slide" class="camera_wrap camera_azure_skin">  
  <? foreach ($gallery as $g): ?>
  <div data-src="<?=AutoThumb::url('/media/'.$g->picture, 620, 347)?>">
  <div class="banner camera_caption fadeFromBottom">
    <p><!--<strong><?=Lang::local($g->name)?></strong>-->
    <!-- <a href="/school/<?=$g->id?>"></a> -->
    <?=Lang::local(strip_tags($g->description))?>
  </p>
</div>
</div>
<? endforeach ?>
</div>

<script src="/js/camera.js" async></script>