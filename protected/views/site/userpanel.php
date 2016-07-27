<div class="grid_12">
	<div class="inner-block">
		<div class="bg-white pad-1 top">
			<div class="form-title"><?=Yii::t('app', 'userpanel')?></div>
			
			<div class="login-text"><?=$user->login?>(<a href="/logout"><?=Yii::t('auth', 'logout')?></a>)</div>
			
			<? if ($payments): ?>
			<h2>Payments</h2>
			<table class="payments">
			<tr>
				<th>#</th>
				<th>School</th>
				<th>Date</th>
				<th>Amount</th>
				<th>Description</th>
				<th>Details</th>
			</tr>
			<? foreach ($payments as $i => $payment): ?>
			<tr>
				<td><?=$i+1?></td>
				<td><a href="/school/<?=$payment->school_id?>"><?=Lang::local($payment->school->name)?></a></td>
				<td><?=$payment->timestamp?></td>
				<td><?=$payment->amount?></td>
				<td><?=$payment->description?></td>
				<td><?=str_replace("\n", "<br/>\n", $payment->details)?></td>
			</tr>
			<? endforeach ?>
			</table>
			<? endif ?>
		</div>
	</div>
</div>
