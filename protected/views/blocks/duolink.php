<div class="duo-link">

  <h2 class="duo-link__title"><?=Yii::t('app', 'searchsurf')?></h2>

  <!-- <form id="duo-form" class="duo-link__form" method="post">

    <label><span><?=Yii::t('app', 'location')?></span>

      <select class="duo-link__select" name="area">

        <option value=""><?=Yii::t('app', 'allarea')?></option>

        <? foreach (Location::getLocations() as $k => $v):?>
        <option value="<?=$k?>"><?=$v?></option>
        <? endforeach ?>

      </select>

    </label>
  
  </form> -->

  <a href="/equipment" class="button button--duo" id="rent-btn"><?=Yii::t('app', 'renteq')?></a>
  <a href="/school" class="button button--duo" id="surf-btn"><?=Yii::t('app', 'findsurf')?></a>


</div>

<!-- <script>
	document.addEventListener('DOMContentLoaded',function() {
	document.querySelector('select[name="area"]').onchange = changeArea;
},false);

function changeArea(event) {
	let areaNum = event.target.value;
  document.getElementById('rent-btn').href += ('?area=' + areaNum);
  document.getElementById('surf-btn').href += ('?area=' + areaNum);
}
</script> -->