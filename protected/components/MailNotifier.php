<?

class MailNotifier extends CComponent
{
	static public function mail($mail, $subject, $body, $headers)
	{
		// $log = fopen($_SERVER['DOCUMENT_ROOT'].'/mail.log', 'a');
		// fwrite($log, date('Y-m-d h:i:s')."\n");
		// fwrite($log, "mail($mail, $subject, text(".strlen($body)."))\n");
		// fclose($log);
		mail($mail, $subject, $body, $headers);
	}
	
	static public function notify($transactionId)
	{
		$transaction = Transaction::model()->findByPk($transactionId);

		$mails = self::getMails($transaction);
		
		// $mails = array();
		// $mails []= array('type' => 'user', 'email' => 'ahz265@gmail.com');
		// $mails []= array('type' => 'admin', 'email' => 'ahz265@gmail.com');
		// $mails []= array('type' => 'school', 'email' => 'ahz265@gmail.com');
		
		// $mails []= array('type' => 'user', 'email' => 'info@surf-tarifa.com');
		// $mails []= array('type' => 'admin', 'email' => 'info@surf-tarifa.com');
		// $mails []= array('type' => 'school', 'email' => 'info@surf-tarifa.com');
		// $mails = array_merge($mails, self::getMails($transaction));
		
		//$mails = array('ahz265@gmail.com'); //TODO: remove this
		//print_r($mails);exit;
		$subject='=?UTF-8?B?'.base64_encode('Surf-tarifa automatic notification').'?=';
		$headers="From: Surf-tarifa administration <noreply@{$_SERVER['HTTP_HOST']}>\r\n".
			"MIME-Version: 1.0\r\n".
			"Content-type: text/html; charset=UTF-8";

		//var_dump($mails);exit;
		
		foreach ($mails as $mail)
		{
			$body = self::getBody($transaction, $mail['type']);
			self::mail($mail['email'], $subject, $body, $headers);
		}
	}

	static protected function getMails($transaction)
	{
		$userEmail = $transaction->user->email;
		$adminEmail = Yii::app()->params['adminEmail'];
		$schoolEmail = $transaction->school->user->email;

		$mails = array(
			array('type' => 'user', 'email' => $userEmail),
			array('type' => 'admin', 'email' => $adminEmail),
			array('type' => 'school', 'email' => $schoolEmail),
		);
		
		return $mails;
	}
	
	static protected function getBody($transaction, $type)
	{
		$details = $transaction->getDetailsArray();
	
		$rows = '';
		foreach ($details as $d)
			$rows .= '<tr><td>'.Yii::t('app', ucfirst($d[0])).' </td><td>'.ucfirst($d[1])."</td></tr>\n";
	
		$banners = Banner::model()->findAll('mail = 1');
		
		$bannersHTML = '';
		foreach ($banners as $banner)
			$bannersHTML .= "<br><img src='http://{$_SERVER['HTTP_HOST']}/media/{$banner->picture}' />";
		
		$page = Page::model()->find('slug = :slug', array('slug' => 'success'));
		$greeting = Lang::local($page->content);
		
		switch ($type)
		{
			case 'user':
				$header = Yii::t('app', 'user_mail_header');
				break;
			case 'school':
				$whatfor = Yii::t('app', $transaction->subject == 'course' ? 'for_course' : 'for_rent');
				$header = Yii::t('app', 'school_mail_header', array('{school}' => Lang::local($transaction->school->name), '{whatfor}' => $whatfor));
				break;
			default:
				$header = "User #{$transaction->user->id}(({$transaction->user->login}) makes an order:";
				
		}
		
		
		$body = <<<MAIL
$header

$greeting

<table>
$rows
</table>

$bannersHTML
MAIL;
// 		die($body);
		return $body;
	}
}