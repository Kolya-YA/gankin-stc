<?
class RegisterForm extends CFormModel
{
	public $login;
	public $email;
	public $password;
	public $password2;

	private $_identity;

	public function rules()
	{
		return array(
			array('login, password, password2, email', 'required'),
			array('email', 'email'),
			array('password', 'compare', 'compareAttribute' => 'password2', 'message' => Yii::t('auth', 'password_match')),
		);
	}

	public function attributeLabels()
	{
		return array(
			'email'     => 'E-mail',
			'password2' => Yii::t('auth', 'password_confirm'),
			'login'     => Yii::t('auth', 'username'),
			'password'  => Yii::t('auth', 'password'),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			return true;
		}
		else
			return false;
	}
}
