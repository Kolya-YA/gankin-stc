<?php

/**
 * This is the model class for table "school".
 *
 * The followings are the available columns in table 'school':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property string $year
 * @property string $location
 * @property string $owner
 * @property string $phone
 * @property string $email
 * @property string $account
 * @property string $beaches
 * @property integer $on_index
 *
 * The followings are the available model relations:
 * @property Course[] $courses
 * @property SchoolBranch[] $schoolBranches
 * @property SchoolPrice[] $schoolPrices
 */
class School extends ActiveRecord
{
	protected $multilang = array('name', 'description', 'short_description');
	protected $sets = array('beaches');
	public $branches = array();
	public $prices = array();
	public $branch = array();
	public $price = 0;
	
	public $accept = false;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return School the static model class
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
		return 'school';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, short_description, description, picture, year, location, owner, phone, email, account, beaches', 'required'),
			array('on_index', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('picture, location, owner, phone, email, account, beaches', 'length', 'max'=>127),
			array('year', 'length', 'max'=>4),
			array('picture', 'file','types'=>'png,jpg,jpeg', 'allowEmpty'=>true,'on'=>'insert,update'),
			array('work_from, work_to', 'safe'),
// 			array('agree', 'required', 'on' => 'school'),
			array('accept', 'compare', 'on' => 'school', 'compareValue' => '1', 'message' => 'Read and accept terms & conditions'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, short_description, description, picture, year, location, owner, phone, email, account, beaches, on_index', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'courses' => array(self::HAS_MANY, 'Course', 'school_id'),
// 			'branches' => array(self::HAS_MANY, 'SchoolBranch', 'school_id'),
// 			'prices' => array(self::HAS_MANY, 'SchoolPrice', 'school_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'short_description' => 'Short description',
			'picture' => 'Picture',
			'year' => 'Year of creation',
			'location' => 'Location',
			'owner' => 'Owner',
			'phone' => 'Phone',
			'email' => 'Email',
			'account' => 'Bank account',
			'beaches' => 'Beaches',
			'on_index' => 'On Index',
			//'accept' => Yii::t('app', 'accept'),
			'accept' => Yii::t('app', 'accept_school'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('account',$this->account,true);
		$criteria->compare('beaches',$this->beaches,true);
		$criteria->compare('on_index',$this->on_index);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
	{
		if ($this->isNewRecord)
			$this->user_id = Yii::app()->user->id;
			
		if (Yii::app()->user->role != 'admin')
			unset($this->on_index);
			
		return parent::beforeSave();
	}
	
	protected function afterSave()
	{
		foreach (School::getSurfTypes() as $k=>$v)
		{
			if (!isset($this->branch[$k]) || !$this->branch[$k])
			{
				if ($this->branches[$k]->id)
					$this->branches[$k]->delete();
					
				foreach (School::getLessonTypes() as $lk => $lv)
					foreach (School::getDurations() as $dk => $dv)
					{
						$price = $this->prices[$k][$lk][$dk];
						if ($price->id)
							$price->delete();
					}
			}
			else
			{
				$this->branches[$k]->school_id = $this->id;
				$this->branches[$k]->type = $k;
				$this->branches[$k]->save();
				
				foreach (School::getLessonTypes() as $lk => $lv)
					foreach (School::getDurations() as $dk => $dv)
					{
						$price = $this->prices[$k][$lk][$dk];
						if (!$price->price)
						{
							if (!$price->isNewRecord)
								$price->delete();
						}
						else
						{
							$price->school_id = $this->id;
							$price->type = $k;
							$price->lesson_type = $lk;
							$price->duration = $dk;
							$price->save();
						}
					}
			}
		}

			
		return parent::afterSave();
	}
	
	
	
	public static function getSchools()
	{
		$db = Yii::app()->db;
		$criteria = new CDbCriteria;
		
		$command = $db->createCommand();
		
		$command->select('id, name')->from('school');
		if (Yii::app()->user->role != 'admin')
			$command->where('user_id = :uid', array('uid' => Yii::app()->user->id));
		
		
		$dict = $command->queryAll();
		
		$res = array();
		if ($dict)
			foreach ($dict as $row)
				$res[$row['id']] = Lang::local($row['name']);
			
		return $res;
	}
	
	public static function getSurfTypes()
	{
		return array(
			'surf' => Yii::t('search', 'surf'), 
			'wind' => Yii::t('search', 'windsurf'), 
			'kite' => Yii::t('search', 'kitesurf'), 
			'paddle' => Yii::t('search', 'paddlesurf'));
	}
	
	public static function getLessonTypes()
	{
		return array(
			'personal' => Yii::t('search', 'private'), 
			'couple' => Yii::t('search', 'two_person'), 
			'group' => Yii::t('search', 'group'));
	}
	
	public static function getDurations()
	{
		return array(3 => 3, 6 => 6, 9 => 9, 12 => 12, 15 => 15);
	}
	
	public static function getSkills()
	{
		return array(
			'novice' => Yii::t('search', 'beginner'),
			'intermediate' => Yii::t('search', 'intermediate'), 
			'sport' => Yii::t('search', 'sport'));
	}
	
	public static function getDays()
	{
		$res = array();
		
		for ($i = 1; $i <= 14; $i++)
			$res[$i] = $i;
		
		return $res;
	}
	
	public static function findEquipment($filter, $id = false)
	{
		$criteria = new CDbCriteria;
		
		if ($id)
		{
			$criteria->addCondition('t.id = :id');
			$criteria->params['id'] = $id;
		}
		
		if ($filter->location)
		{
			$criteria->compare('beaches',  $filter->location, true);
			//$criteria->addCondition('location = :location');
			//$criteria->params['location'] = $filter->location;
		}
		
		$criteria->join = "JOIN school_branch b ON b.school_id = t.id";
		$criteria->addCondition('b.type = :type');
		$criteria->params['type'] = $filter->type;

		$criteria->select = 't.*, b.rent_prices as price';
// 		$criteria->order = 'rand()';
		$criteria->limit = '20';
		
		$results = School::model()->findAll($criteria);
		
		
		$days = $filter->days;

		if ($results)
		{
			foreach ($results as $i => $school)
			{
				$school->price = json_decode($school->price, true);
				$price = $school->price[$filter->rent_type][$days - 1];
				if (!$price)
					unset($results[$i]);
// 					$price = $school->price[$filter->rent_type][0] * $days;
				$school->price = $filter->count * $price;
			}

			usort($results, function ($a, $b){
				return $a->price > $b->price;
			});
		}
		
		return $results;
	}
	
	
	public static function findCourse($filter, $id = false)
	{
		$criteria = new CDbCriteria;
		
		if ($id)
		{
			$criteria->addCondition('t.id = :id');
			$criteria->params['id'] = $id;
		}
		
		if ($filter->location)
		{
			$criteria->compare('beaches',  $filter->location, true);
// 			$criteria->addCondition('location = :location');
// 			$criteria->params['location'] = $filter->location;
		}
		
		$criteria->join = "JOIN school_branch b ON b.school_id = t.id";
		$criteria->addCondition('b.type = :type');
		$criteria->params['type'] = $filter->type;
		
		$criteria->join .= " JOIN school_price p ON p.school_id = t.id";
		$criteria->addCondition('p.type = :type');
		$criteria->addCondition('p.lesson_type = :lesson');
		$criteria->addCondition('p.duration = :duration');
		$criteria->params['lesson'] = $filter->lesson;
		$criteria->params['duration'] = $filter->duration;
		
		$criteria->join .= " JOIN course c ON c.school_id = t.id AND c.type = p.type";
		
		$criteria->group = "t.id";

		if ($filter->age)
		{
			$criteria->addCondition('c.min_age = 0 OR c.min_age <= :age');
			$criteria->addCondition('c.max_age = 0 OR c.max_age >= :age');
			$criteria->params['age'] = $filter->age;
		}
		
		if ($filter->language)
		{
			$criteria->addCondition('FIND_IN_SET(:lang, c.languages)');
			$criteria->params['lang'] = $filter->language;
		}

		if ($filter->level)
		{
			$criteria->addCondition('FIND_IN_SET(:skill, c.skill)');
			$criteria->params['skill'] = $filter->level;
		}

		if ($filter->sex)
		{
			$criteria->addCondition('FIND_IN_SET(:sex, c.sex)');
			$criteria->params['sex'] = $filter->sex;
		}

		$criteria->select = 't.*, p.price as price';
		$criteria->order = 'price ASC';
		$criteria->limit = '20';
		
		$results = School::model()->findAll($criteria);
		
		if ($results)
			foreach ($results as $school)
			{
				$school->price = $filter->amount * $school->price;
			}
			
		return $results;
	}
	
}