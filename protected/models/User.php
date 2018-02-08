<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $role
 * @property string $firstname
 * @property string $lastname
 * @property integer $sex
 * @property string $phone
 * @property string $city
 */
class User extends CActiveRecord
{
	public $password2;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, role, email', 'required'),
			array('password, password2', 'required', 'on'=>'create'),
			array('password, password2', 'safe'/*, 'on'=>'update'*/),
			array('confirmed', 'safe'),
			array('sex', 'numerical', 'integerOnly'=>true),
			array('login, password, phone', 'length', 'max'=>45),
			array('role', 'length', 'max'=>6),
			array('email, firstname, lastname, city', 'length', 'max'=>127),
			
			array('password', 'compare', 'compareAttribute' => 'password2', 'message' => Yii::t('auth', 'password_match')),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, password, role, firstname, lastname, sex, phone, city', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'schools' => array(self::HAS_MANY, 'School', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'email' => 'E-mail',
			'password' => 'Password',
			'password2' => Yii::t('auth', 'password_confirm'),
			'role' => 'Role',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'sex' => 'Sex',
			'phone' => 'Phone',
			'city' => 'City',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('confirmed',$this->confirmed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function pwHash($pw)
	{
		return md5("YOBA{$pw}CODE");
	}
	
// 	public function setPassword($password) 
// 	{
// 		$this->password = User::pwHash($password);
// 	}
	
	protected function beforeSave(){
		if(!parent::beforeSave())
			return false;
		if ($this->password)
			$this->password = self::pwHash($this->password);
		else
			unset($this->password);
			
		return true;
	}

	public function getChangePasswordKey()
	{
		return md5('(_'.$this->id.$this->password.date("Y-m-d").'_)');
	}
	
	public static function tryConfirm($id, $key)
	{
		$success = password_verify($id, $key);
		if ($success)
		{
			Yii::app()->db->createCommand()
				->update('user', array('confirmed' => 1), 'id=:id', array(':id' => $id));
		}
		return $success;
	}
	
	public function sendConfirmationMail()
	{
		$key = password_hash($this->id, PASSWORD_DEFAULT);
		$url = "https://{$_SERVER['HTTP_HOST']}/confirmation?key=$key&user_id={$this->id}";
		$to = $this->email;
		$subject = "Registration confirmation {$_SERVER['SERVER_NAME']}";
		$headers  = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8' . "\r\n" .
            "From: surf-tarifa <noreply@{$_SERVER['SERVER_NAME']}>\r\n" .
		    "Reply-To: noreply@{$_SERVER['SERVER_NAME']}\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		$message = "To confirm e-mail follow this link: <a href=$url>$url</a>.<br>";
		mail($to, $subject, $message, $headers);
// 		die($message);
	}

	public function sendRecoveryMail()
	{
		$key = $this->getChangePasswordKey();
//		$key = password_hash($this->id.$this->password.date("Y-m-d"), PASSWORD_DEFAULT);
		$url = "http://{$_SERVER['HTTP_HOST']}/recover?key=$key&user={$this->id}";
		
		$to      = $this->email;
		$subject = "Password recovery {$_SERVER['SERVER_NAME']}";
		$message = "To reset your password follow link: <a href=$url>$url</a>.";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "From: surf-tarifa <noreply@{$_SERVER['SERVER_NAME']}>\r\n" .
		"Reply-To: noreply@{$_SERVER['SERVER_NAME']}\r\n" .
		'X-Mailer: oche mailer agent';
		mail($to, $subject, $message, $headers);
// 		die($message);
	}
}