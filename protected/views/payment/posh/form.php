<form method="post" 
	action="https://posh.montrada.de/posh/formservice/pspng/main" 
	enctype="application/x-www-form-urlencoded"  
	accept-charset="UTF-8" 
	id="posh-form"
	> 
  <input type="hidden" name="merchid" value="<?=Yii::app()->Posh->merchId?>"> 
  <input type="hidden" name="orderid" value="<?=$transaction->id?>"> 
  <input type="hidden" name="payments" value="<?=Yii::app()->Posh->payments?>"> 
  <input type="hidden" name="amount" value="<?=$transaction->roundAmount?>"> 
  <input type="hidden" name="currency" value="EUR"> 
  <input type="hidden" name="command" value="<?=Yii::app()->Posh->command?>"> 
  <input type="hidden" name="timestamp" value="<?=Yii::app()->Posh->getTimestamp()?>"> 
  <input type="hidden" name="psphash" value="<?=Yii::app()->Posh->getHash($transaction)?>"> 
  <input type="hidden" name="url" value="<?=Yii::app()->Posh->returnUrl?>"> 
  <input type="hidden" name="lang" value="<?=Yii::app()->Posh->getLang()?>"> 
  <? foreach ($transaction->getDetailsArray(false) as $i => $info): ?>
  <input type="hidden" name="w.<?=$i?>.1" value="<?=$info[0]?>"> 
  <input type="hidden" name="w.<?=$i?>.2" value="<?=$info[1]?>"> 
  <? endforeach ?>
</form> 

<script type="text/javascript">
$(function(){
	$('#posh-form').submit();
});
</script>