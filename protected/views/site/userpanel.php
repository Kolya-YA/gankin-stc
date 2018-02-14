<?php
/**
 * @var object $user
 * @var array $payments
 */

?>
<div class="inner-block">
    <h2 class="form-title">
        <?= Yii::t('app', 'userpanel') ?>
    </h2>

    <p><?= $user->login ?></p>
    <p><?= $user->email ?></p>
    <p><?= $user->role ?></p>
    <p><?= $user->confirmed ?></p>
    <hr>

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
                    <td><?= $i + 1 ?></td>
                    <td><a href="/school/<?= $payment->school_id ?>"><?= Lang::local($payment->school->name) ?></a></td>
                    <td><?= $payment->timestamp ?></td>
                    <td><?= $payment->amount ?></td>
                    <td><?= $payment->description ?></td>
                    <td><?= str_replace("\n", "<br/>\n", $payment->details) ?></td>
                </tr>
            <? endforeach ?>
        </table>
    <? endif ?>
    <div class="login-text"> <!--TODO this is no necessary block-->
        <a href="/logout"><?= Yii::t('auth', 'logout') ?></a>
        (<?= $user->login ?>)
    </div>
</div>
