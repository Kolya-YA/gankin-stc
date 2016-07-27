<?php

class PaymentController extends Controller
{
	public $layout = 'inner';
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionComplete()
	{
		//$data = var_export($_REQUEST, true);
		//file_put_contents('request.txt', $data);
		

	}
	
	public function actionSuccess()
	{
		$transaction = Transaction::model()->find(array(
			'condition' => 'user_id=:uid AND id=:orderid',
			'params' => array(
				'uid' => Yii::app()->user->id,
				'orderid' => $_GET['orderid']
			)));
			
		if (!$transaction || !isset($_GET['psphash']))
			$this->redirect('/');

		if (!$transaction->confirmed)
		{
			$secret = Yii::app()->Posh->secretKey;
			$merchid = $_GET['merchid'];
			$orderid = $_GET['orderid'];
			$result = $_GET['result'];
			$amount = $_GET['amount'];
			$currency = $_GET['currency'];
			$trefnum = $_GET['trefnum'];
			$timestamp = $_GET['timestamp'];
			$psphash_get = $_GET['psphash'];
			
			$psphash =
				$secret."-".
				$merchid."-".
				$orderid."-".
				$amount."-".
				$currency."-".
				$result."-".
				$trefnum."-".
				$timestamp;
			
			$hash = hash(sha256, $psphash);
			
			if ($psphash_get == $hash) 
			{
				$transaction = Transaction::model()->findByPk($orderid);
				
				$transaction->token = $trefnum;
				$transaction->confirmed = 1;
				$transaction->save();
				
				MailNotifier::notify($transaction->id);
			}
		}
		
		$page = Page::model()->find('slug = :slug', array('slug' => 'success'));
			
		$banners = Banner::model()->findAll('mail = 1');
		
		$this->render('/paypal/success', array(
			'page' => $page,
			'transaction' => $transaction,
			'banners' => $banners,
		));
	}
}