<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    public $username;
    public $password;
    public $rememberMe;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return [
            // username and password are required
            ['username, password', 'required'],
            ['username, password', 'length', 'min' => 3, 'max' => 32],
            // rememberMe needs to be a boolean
            ['rememberMe', 'boolean'],
            // password needs to be authenticated
            ['password', 'authenticate'],
        ];
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'rememberMe' => Yii::t('auth', 'remember'),
            'username' => Yii::t('auth', 'username'),
            'password' => Yii::t('auth', 'password'),
        ];
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
//	public function authenticate($attribute,$params)
    public function authenticate()
    {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);

            $authErrors = $this->_identity->authenticate();

            if ($authErrors) {
                if ($authErrors == 3)
                    $this->addError('password', "Account is not confirmed."); //TODO add translate
                else if ($authErrors == 4)
                    $this->addError('password', "Your password is too old. Please update it."); //TODO add translate
                else
                    $this->addError('password', "Incorrect username or password  ($authErrors)"); //TODO add translate
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days

            Yii::app()->user->login($this->_identity, $duration);

            return true;
        } else
            return false;
    }
}
