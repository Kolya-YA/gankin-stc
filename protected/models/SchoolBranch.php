<?php

/**
 * This is the model class for table "school_branch".
 *
 * The followings are the available columns in table 'school_branch':
 * @property integer $id
 * @property integer $school_id
 * @property string $type
 * @property string $instructors
 * @property integer $rent
 * @property integer $rent_price_day
 * @property integer $rent_price_hour
 *
 * The followings are the available model relations:
 * @property School $school
 */
class SchoolBranch extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SchoolBranch the static model class
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
		return 'school_branch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('school_id, type', 'required'),
			array('school_id, instructors, rent', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>6),
			array('rent_prices', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, school_id, type, instructors, rent, rent_price_day, rent_price_hour', 'safe', 'on'=>'search'),
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
			'school_id' => 'School',
			'type' => 'Type',
			'instructors' => 'Instructors',
			'rent' => 'Rent',
			'rent_prices' => 'Rent price per day',
// 			'rent_price_day' => 'Rent Price Day',
// 			'rent_price_hour' => 'Rent Price Hour',
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
		$criteria->compare('school_id',$this->school_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('instructors',$this->instructors);
		$criteria->compare('rent',$this->rent);
		$criteria->compare('rent_price_day',$this->rent_price_day);
		$criteria->compare('rent_price_hour',$this->rent_price_hour);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	protected function beforeSave()
	{
		if (is_array($this->rent_prices))
			$this->rent_prices = json_encode($this->rent_prices);
		
		return parent::beforeSave();
	}
}