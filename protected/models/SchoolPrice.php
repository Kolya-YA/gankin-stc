<?php

/**
 * This is the model class for table "school_price".
 *
 * The followings are the available columns in table 'school_price':
 * @property integer $id
 * @property integer $school_id
 * @property string $type
 * @property string $lesson_type
 * @property string $duration
 * @property integer $price
 *
 * The followings are the available model relations:
 * @property School $school
 */
class SchoolPrice extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SchoolPrice the static model class
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
		return 'school_price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('school_id, type, lesson_type, duration, price', 'required'),
			array('school_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('type', 'length', 'max'=>6),
			array('lesson_type', 'length', 'max'=>8),
			array('duration', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, school_id, type, lesson_type, duration, price', 'safe', 'on'=>'search'),
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
			'lesson_type' => 'Lesson Type',
			'duration' => 'Duration',
			'price' => 'Price',
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
		$criteria->compare('lesson_type',$this->lesson_type,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('price',$this->price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}