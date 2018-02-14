<?php

/**
 * ReciveryForm class.
 * It is used by the 'recovery' action of 'SiteController'.
 */
class RecoveryForm extends CFormModel
{
	public $email;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return [
			['email', 'required'],
            ['email', 'length', 'max' => '254'],
            ['email', 'email'],
            ['email', 'exist', 'className' => 'User', 'attributeName' => 'email', 'message' => Yii::t('auth', 'login_notexist')]
        ];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
			'password'=>'E-mail',
        ];
	}

	/**
	 *
	 */

	public function sendRecoveryMail() //TODO https !
    {
        $user = User::model()->findByAttributes(array('email' => $this->email));
		$key = User::getChangePasswordKey($user);

        $url = "http://{$_SERVER['HTTP_HOST']}/recover?key=$key&user={$user->id}";
        $to      = $user->email;
        $subject = "Password recovery message from {$_SERVER['SERVER_NAME']}";
        $message = "<h1>Password Recovery</h1><p>To reset your password follow this link: <a href=$url>Reset</a>.</p>";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From: surf-tarifa <noreply@{$_SERVER['SERVER_NAME']}>\r\n" .
            "Reply-To: noreply@{$_SERVER['SERVER_NAME']}\r\n" .
            'X-Mailer: PHP/' . phpversion();

        return mail($to, $subject, $message, $headers);
        //        D::dump($to."\n".$subject."\n".$message."\n".$headers);
//        D::dump($user->id."\n".date("Y-m-d")."\n"."\n".$user->password."\n".$key);
//        D::dump($user->id."\n".date("Y-m-d")."\n".date('Y-m-d', strtotime(' + 55 days'))."\n".$user->password."\n".$key);
// 		die();
    }
}
