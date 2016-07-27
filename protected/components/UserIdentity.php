<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 
	public function forceId($id)
	{
		$record=User::model()->findByPk($id);
		if($record)
		{
			$this->id = $record->id;
			$this->setState('role', $record->role);
		}
	}
	
	public function authenticate()
	{
		$record=User::model()->findByAttributes(array('login' => $this->username));

		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->password !== User::pwHash($this->password))
		{
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else
		{
			if ($record->role == 'user' && !$record->confirmed)
			{
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
			else
			{
				$this->id = $record->id;
				$this->setState('role', $record->role);
				$this->errorCode=self::ERROR_NONE;
			}
		}
		return !$this->errorCode;
	}
	public function getId()
	{
		return $this->id;
	}
}