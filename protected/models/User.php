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
 * @property string $updated
 * @property string $created
 * @property int $confirmed
 */
class User extends CActiveRecord
{
    public $password1;
    public $password2;
    public $key; // key from email for password recovery

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
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
        return [
            ['login, role', 'required'],
            ['login', 'length', 'min' => 3, 'max' => 32],
            ['login', 'unique'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'length', 'max' => '255'],
            ['email', 'unique'],
            ['password1', 'required', 'on' => 'create, newReg, pswUpdate'],
            ['password1', 'length', 'min' => 6, 'max' => 32],
            ['password2', 'compare', 'compareAttribute' => 'password1', 'message' => Yii::t('auth', 'password_match'), 'on' => 'create, newReg, update, pswUpdate'],
            ['sex, confirmed', 'numerical', 'integerOnly' => true],
            ['phone', 'length', 'min' => 3, 'max' => 45],
            ['role', 'length', 'max' => 6],
            ['firstname, lastname, city', 'length', 'max' => 127],
//
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['id, login, role, confirmed', 'safe', 'on' => 'search'],
        ];
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
        return [
            'id' => 'ID',
            'login' => Yii::t('auth', 'username'),
            'email' => 'E-mail',
            'password1' => Yii::t('auth', 'password'),
            'password2' => Yii::t('auth', 'password_confirm'),
            'role' => 'Role',
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'sex' => 'Sex',
            'phone' => 'Phone',
            'city' => 'City',
            'updated' => 'Updated',
            'created' => 'Created',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('login', $this->login, true);
        $criteria->compare('email', $this->email, true);
//		$criteria->compare('password',$this->password,true);
        $criteria->compare('role', $this->role, true);
//		$criteria->compare('firstname',$this->firstname,true);
//		$criteria->compare('lastname',$this->lastname,true);
//		$criteria->compare('sex',$this->sex);
//		$criteria->compare('phone',$this->phone,true);
//		$criteria->compare('city',$this->city,true);
        $criteria->compare('confirmed', $this->confirmed, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function pwHash($pw)
    {
        return md5("YOBA{$pw}CODE");
    }

    protected function beforeSave()
    {
        if (!parent::beforeSave())
            return false;
		if ($this->password1)
        $this->password = password_hash($this->password1, PASSWORD_DEFAULT);
//        $this->password = self::pwHash($this->password1);
		else
			unset($this->password2);

        return true;
    }

    public static function getChangePasswordKey($user)
    {
        return password_hash($user->id . $user->password . date("Y-m-d"), PASSWORD_DEFAULT);
    }

    /**
     * @param string $key hash from confirmation link
     * @return bool
     */
    public function tryConfirm($key)
    {
        $success = password_verify($this->id, $key);
        if ($success) {
            $this->confirmed = 1;
            $this->save();
        }
        return $success;
    }

    public function sendConfirmationMail()
    {
        $key = password_hash($this->id, PASSWORD_DEFAULT);
        $url = "https://{$_SERVER['HTTP_HOST']}/confirmation?key=$key&user_id={$this->id}";
        $to = $this->email;
        $subject = "Registration confirmation {$_SERVER['SERVER_NAME']}";
        $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8' . "\r\n" .
            "From: surf-tarifa <noreply@{$_SERVER['SERVER_NAME']}>\r\n" .
            "Reply-To: noreply@{$_SERVER['SERVER_NAME']}\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $message = "To confirm e-mail follow this link: <a href=$url>$url</a>.<br>";
        return mail($to, $subject, $message, $headers);
    }
}