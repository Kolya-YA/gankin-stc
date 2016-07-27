<?php

/**
 * This is the model class for table "course".
 *
 * The followings are the available columns in table 'course':
 * @property integer $id
 * @property integer $school_id
 * @property string $type
 * @property string $languages
 * @property string $lesson_type
 * @property integer $min_age
 * @property integer $max_age
 * @property string $sex
 * @property string $duration
 * @property string $skill
 *
 * The followings are the available model relations:
 * @property School $school
 */
class Course extends ActiveRecord
{
	public $school_name;
	protected $sets = array('languages', 'lesson_type', 'sex', 'duration', 'skill');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Course the static model class
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
		return 'course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('school_id, type, languages, lesson_type, min_age, max_age, sex, duration, skill', 'required'),
			array('school_id, min_age, max_age', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, school_id, type, languages, lesson_type, min_age, max_age, sex, duration, skill, school_name', 'safe', 'on'=>'search'),
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
			'languages' => 'Languages',
			'lesson_type' => 'Lesson Type',
			'min_age' => 'Min Age',
			'max_age' => 'Max Age',
			'sex' => 'Sex',
			'duration' => 'Duration',
			'skill' => 'Skill',
			'school_name' => 'School Name',
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
		$criteria->compare('languages',$this->languages,true);
		$criteria->compare('lesson_type',$this->lesson_type,true);
		$criteria->compare('min_age',$this->min_age);
		$criteria->compare('max_age',$this->max_age);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('duration',$this->duration,true);
		$criteria->compare('skill',$this->skill,true);
		
		$criteria->select = 't.*, s.name as school_name';
		$criteria->join = 'LEFT JOIN school AS s ON s.id = school_id';

		$criteria->compare('s.name', $this->school_name, true);
		
		if (Yii::app()->user->role != 'admin')
		{
			$criteria->compare('s.user_id', Yii::app()->user->id);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}