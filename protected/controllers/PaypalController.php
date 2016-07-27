<?php

class PaypalController extends Controller
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


// 	public function actionBuy(){
//                
// 		// set 
// 		$paymentInfo['Order']['theTotal'] = 1.00;
// 		$paymentInfo['Order']['description'] = "Some payment description here";
// 		$paymentInfo['Order']['quantity'] = '1';
// 
// 		// call paypal 
// 		$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo); 
// 		//Detect Errors 
// 		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
// 			if(Yii::app()->Paypal->apiLive === true){
// 				//Live mode basic error message
// 				$error = 'We were unable to process your request. Please try again later';
// 			}else{
// 				//Sandbox output the actual error message to dive in.
// 				$error = $result['L_LONGMESSAGE0'];
// 			}
// 			echo $error;
// 			Yii::app()->end();
// 			
// 		}else { 
// 			// send user to paypal 
// 			$token = urldecode($result["TOKEN"]); 
// 			
// 			$payPalURL = Yii::app()->Paypal->paypalUrl.$token; 
// 			$this->redirect($payPalURL); 
// 		}
// 	}

	public function actionConfirm()
	{
		$token = trim($_GET['token']);
		$payerId = trim($_GET['PayerID']);
		
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);

		$transaction = Transaction::model()->find('token = :token', array('token' => $token));
		if (!$transaction)
			throw new CHttpException(404);
		
		$result['PAYERID'] = $payerId; 
		$result['TOKEN'] = $token; 
		$result['ORDERTOTAL'] = $transaction->amount;

		//Detect errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if (!$transaction->confirmed)
				$transaction->delete();
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
		}else{ 
			
			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
			//Detect errors  
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if (!$transaction->confirmed)
					$transaction->delete();
				
				if(Yii::app()->Paypal->apiLive === true){
					//Live mode basic error message
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
					$error = $paymentResult['L_LONGMESSAGE0'];
				}
				echo $error;
				Yii::app()->end();
			}else{
				//payment was completed successfully
				
				$transaction->confirmed = 1;
				$transaction->save();
				$_SESSION['lastTransaction'] = $transaction->id;

				MailNotifier::notify($transaction->id);

				$this->redirect('/paypal/success');
				//$this->render('confirm');
			}
			
		}
	}
        
	public function actionCancel()
	{
		//The token of the cancelled payment typically used to cancel the payment within your application
		if (!isset($_GET['token']))
			throw new CHttpException(404);
		$token = $_GET['token'];
		
		Transaction::model()->find('token = :token AND confirmed = 0 AND user_id = :uid', array(
			'token' => $token,
			'uid' => Yii::app()->user->id,
			))->delete();
		
		$this->render('cancel');
	}
	
	public function actionDirectPayment(){ return;
		$paymentInfo = array('Member'=> 
			array( 
				'first_name'=>'name_here', 
				'last_name'=>'lastName_here', 
				'billing_address'=>'', 
				'billing_address2'=>'', 
				'billing_country'=>'', 
				'billing_city'=>'', 
				'billing_state'=>'', 
				'billing_zip'=>'' 
			), 
			'CreditCard'=> 
			array( 
				'card_number'=>'4527161245087834', 
				'expiration_month'=>'8', 
				'expiration_year'=>'2018', 
				'cv_code'=>'',
				'credit_type'=>'',
			), 
			'Order'=> 
			array('theTotal'=>1.00) 
		); 

	   /* 
		* On Success, $result contains [AMT] [CURRENCYCODE] [AVSCODE] [CVV2MATCH]  
		* [TRANSACTIONID] [TIMESTAMP] [CORRELATIONID] [ACK] [VERSION] [BUILD] 
		*  
		* On Fail, $ result contains [AMT] [CURRENCYCODE] [TIMESTAMP] [CORRELATIONID]  
		* [ACK] [VERSION] [BUILD] [L_ERRORCODE0] [L_SHORTMESSAGE0] [L_LONGMESSAGE0]  
		* [L_SEVERITYCODE0]  
		*/ 
	  
		$result = Yii::app()->Paypal->DoDirectPayment($paymentInfo); 
		
		//Detect Errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			
		}else { 
			D::dump($result);
// 			$this->render('confirm');
// 			$this->refresh();
		}

		Yii::app()->end();
	} 
	
	public function actionSuccess()
	{
		$tid = +$_SESSION['lastTransaction'];
		
		if (!$tid)
			throw new CHttpException(404);
			
		$page = Page::model()->find('slug = :slug', array('slug' => 'success'));
		$transaction = Transaction::model()->findByPk($tid);
		$banners = Banner::model()->findAll('mail = 1');
		
		//var_dump($transaction->id);
		$this->render('success', array(
			'page' => $page,
			'transaction' => $transaction,
			'banners' => $banners,
		));
	}
}