<?

class SchoolForm extends FilterForm
{
	public $location;
	public $type;
	public $date_from;
	public $date_to;
	public $amount;
	public $age;
	public $sex;
	public $lesson;
	public $level;
	public $language;
	public $duration;

	public function rules()
	{
		return array(
			array('date_from, date_to, type, amount, location, lesson, duration', 'required'),
			array('amount, age', 'numerical', 'integerOnly'=>true),
			array('sex, level, language', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'location'=> Yii::t('search', 'location'),
			'type' => Yii::t('search', 'type'),
			'date_from' => Yii::t('search', 'date_from'),
			'date_to' => Yii::t('search', 'date_to'),
			'amount' => Yii::t('search', 'amount'),
			'age' => Yii::t('search', 'age'),
			'sex' => Yii::t('search', 'sex'),
			'lesson' => Yii::t('search', 'lesson'),
			'level' => Yii::t('search', 'level'),
			'language' => Yii::t('search', 'language'),
			'duration' => Yii::t('search', 'duration'),
		);
	}
	
	public function getDetails()
	{
		$types = School::getSurfTypes();
		$lesson_types = School::getLessonTypes();
		$langs = Lang::getLangs();
		$levels = School::getSkills();
		$durations = School::getDurations();
		
		$res = array(
			array('name' => Yii::t('search', 'type'), 'value' => $types[$this->type]),
			array('name' => Yii::t('search', 'date_from'), 'value' => $this->date_from),
			array('name' => Yii::t('search', 'date_to'), 'value' => $this->date_to),
			array('name' => Yii::t('search', 'amount'), 'value' => $this->amount),
			array('name' => Yii::t('search', 'lesson'), 'value' => $lesson_types[$this->lesson]),
			array('name' => Yii::t('search', 'duration'), 'value' => $durations[$this->duration]),
		);
		if ($this->age)
			$res [] = array('name' => Yii::t('search', 'age'), 'value' => $this->age);
		if ($this->sex)
			$res [] = array('name' => Yii::t('search', 'sex'), 'value' => $this->sex);
		if ($this->level)
			$res [] = array('name' => Yii::t('search', 'level'), 'value' => $levels[$this->level]);
		if ($this->language)
			$res [] = array('name' => Yii::t('search', 'language'), 'value' => $langs[$this->language]);
		
		return $res;
	}
}