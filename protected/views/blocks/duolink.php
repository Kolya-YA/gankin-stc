<div class="duo-link">

  <h2 class="form-title"><?=Yii::t('app', 'searchsurf')?></h2>
  <img src="/images/surfer.jpg" class="side-ico" alt="">

  <form id="form1" class="form-style" method="post">

    <label><span><?=Yii::t('app', 'location')?></span>

      <select class="select1" name="area">

        <option value=""><?=Yii::t('app', 'allarea')?></option>

        <? foreach (Location::getLocations() as $k => $v):?>
        <option value="<?=$k?>"><?=$v?></option>
        <? endforeach ?>

      </select>

    </label>

    <a href="/equipment" class="button" id="rent-btn"><?=Yii::t('app', 'renteq')?></a>
    <a href="/school" class="button" id="surf-btn"><?=Yii::t('app', 'findsurf')?></a>

  </form>

</div>

<script>
	document.addEventListener('DOMContentLoaded',function() {
	document.querySelector('select[name="area"]').onchange=changeArea;
},false);

function changeArea(event) {
	let areaNum = event.target.value;
  document.getElementById('rent-btn').href = '/equipment?area=' + areaNum;
  document.getElementById('surf-btn').href = '/school?area=' + areaNum;
}
</script>