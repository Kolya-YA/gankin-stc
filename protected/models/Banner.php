<?php

/**
 * This is the model class for table "banner".
 *
 * The followings are the available columns in table 'banner':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $link
 * @property integer $content
 * @property string $picture
 * @property integer $top_index
 * @property integer $index
 * @property integer $left_course
 * @property integer $right_course
 * @property integer $left_equipment
 * @property integer $right_equipment
 */
class Banner extends ActiveRecord
{
	protected $multilang = array('name', 'description','keywords', 'content');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banner the static model class
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
		return 'banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('picture', 'required'), //, top_index, index, left_course, right_course, left_equipment, right_equipment
			array('top_index, index, left_course, right_course, left_equipment, right_equipment, search_result, payment, mail', 'numerical', 'integerOnly'=>true),
			array('link, picture', 'length', 'max'=>127),
			array('name, content, description, keywords', 'safe'),
//			array('picture', 'file','types'=>'png,jpg,jpeg', 'allowEmpty'=>true,'on'=>'insert,update'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, keywords, link, content, picture, top_index, index, left_course, right_course, left_equipment, right_equipment', 'safe', 'on'=>'search'),
			array('picture', 'file','types'=>'png,jpg,jpeg', 'allowEmpty'=>true,'on'=>'insert,update', 'safe' => false),
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
			'name' => 'Name',
			'description' => 'Short description',
			'keywords' => 'Keywords',
			'link' => 'External link(optional)',
			'content' => 'Content',
			'picture' => 'Picture',
			'top_index' => 'Show on index (top block)',
			'index' => 'Show on index (content block)',
			'left_course' => 'Show on find course page',
			'right_course' => 'Not used —— Right column on find course page',
			'left_equipment' => 'Show on equipment search page',
			'right_equipment' => 'Not used —— Right column on find equipment page',
			'search_result' => 'Search result page',
			'payment' => 'Payment page',
			'mail' => 'In mail template',
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
		$criteria->compare('keywords',$this->keywords);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('content',$this->content, true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('top_index',$this->top_index);
		$criteria->compare('index',$this->index);
		$criteria->compare('left_course',$this->left_course);
		$criteria->compare('right_course',$this->right_course);
		$criteria->compare('left_equipment',$this->left_equipment);
		$criteria->compare('right_equipment',$this->right_equipment);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}