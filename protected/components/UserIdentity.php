<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_USERNAME_NOT_ACTIVE = 3;

    private $id;

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */

    public function authenticate()
    {
        $user = User::model()->findByAttributes(array('login' => $this->username));

        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
// 7a972ddaae4d9b13ac4dbf8f2c7125e4
//        else if ($record->password !== User::pwHash($this->password)) {
        else if (!password_verify($this->password, $user->password)) {

            if ($user->password == User::pwHash($this->password)) {

                $user->password = password_hash($this->password, PASSWORD_DEFAULT);
                $user->save(false);

            } else {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            }

        } else {
            if (!$user->confirmed) {
                $this->errorCode = self::ERROR_USERNAME_NOT_ACTIVE;
            } else {
                $this->id = $user->id;
                $this->setState('role', $user->role);
                $this->errorCode = self::ERROR_NONE;
            }
        }

        return $this->errorCode;
    }

    public function forceId($id)
    {
//        $record = User::model()->findByPk($id);
//        if ($record) {
//            $this->id = $record->id;
        $this->id = $id;
//            $this->setState('role', $record->role);
//        }
    }

    public function getId()
    {
        return $this->id;
    }
}