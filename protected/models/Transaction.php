<?php

/**
 * This is the model class for table "transaction".
 *
 * The followings are the available columns in table 'transaction':
 * @property integer $id
 * @property integer $user_id
 * @property integer $school_id
 * @property string $token
 * @property string $timestamp
 * @property double $amount
 * @property string $description
 * @property string $details
 * @property integer $confirmed
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $school
 */
class Transaction extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transaction the static model class
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
		return 'transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, school_id, amount, details, full, type, subject', 'required'),
			array('user_id, school_id, confirmed, full', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('token, description', 'length', 'max'=>127),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, school_id, token, timestamp, amount, description, details, confirmed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'school' => array(self::BELONGS_TO, 'School', 'school_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'school_id' => 'School',
			'token' => 'Token',
			'timestamp' => 'Timestamp',
			'amount' => 'Amount',
			'description' => 'Description',
			'details' => 'Details',
			'confirmed' => 'Confirmed',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('school_id',$this->school_id);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('timestamp',$this->timestamp,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('confirmed',$this->confirmed);
		
		if (Yii::app()->user->role != 'admin')
		{
			$criteria->join = 'LEFT JOIN school AS s ON s.id = school_id';
			$criteria->compare('s.user_id', Yii::app()->user->id);
		}
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getDetailsArray($full = true)
	{
		$details = array();

		if ($full)
			$details[] = array(Yii::t('app', 'Order Number'), $this->id);
		$details[] = array(Yii::t('app', 'School'), Lang::local($this->school->name));
		$details[] = array(Yii::t('app', 'Subject'), Yii::t('app', $this->subject));
		
		$detailsInfo = explode("\n", trim($this->details));
		foreach ($detailsInfo as $d)
			$details[] = explode(': ', $d);
		
		$details[] = array(Yii::t('app', 'Location'), $this->school->location);
			
		$details[] = array(Yii::t('app', 'Payment'), $this->full ? Yii::t('app', 'full') : '20%');
		if ($full)
			$details[] = array(Yii::t('app', 'Total'), $this->amount . '€');

		return $details;
	}
	
	public function getRoundAmount()
	{
		return floor($this->amount * 100);
	}
}