<?php

/**
 * This is the model class for table "lang".
 *
 * The followings are the available columns in table 'lang':
 * @property integer $id
 * @property string $code
 * @property string $name
 */
class Lang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Lang the static model class
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
		return 'lang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name', 'required'),
			array('code', 'length', 'max'=>2),
			array('name', 'length', 'max'=>127),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'name' => 'Name',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	static function getSiteLangs()
	{
		return array(
			'en' => 'English',
			'es' => 'Español',
			'de' => 'Deutsch',
			'ru' => 'Русский',
		);
	}

	static function getLangs()
	{
		$res = array();
		$langs = Lang::model()->findAll();
		
		foreach ($langs as $l)
			$res[$l->code] = $l->name;
			
		return $res;
	}
	
	static function missingTranslation($event)
	{
		if ($event->language != 'en')
			$event->message = Yii::t($event->category, $event->message, array(), NULL, 'en');
	}
	
	static function def($string)
	{
		if (!is_array($string))
			$string = json_decode($string, true);
		if (!$string)
			return;

		if (isset($string['en']))
			return $string['en'];
		else 
			return array_shift($string);
	}
	
	static function getCurrentUrl($lang)
	{
		if ($lang == 'en')
			$site = 'surf-tarifa.com';
		else
			$site = $lang . '.surf-tarifa.com';
			
		return "//{$site}{$_SERVER['REQUEST_URI']}";
	}
	
	static function local($string)
	{
		$lang = Yii::app()->language;
		
		if (!is_array($string))
			$string = json_decode($string, true);
		if (!$string)
			return;
// 		D::dump($string);
		if (isset($string[$lang]))
			return $string[$lang];
		else if (isset($string['en']))
			return $string['en'];
		else 
			return array_shift($string);
	}
}