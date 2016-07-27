<?

class EquipmentForm extends FilterForm
{
	public $location;
	public $type;
	public $pick_date;
// 	public $return_date;
	public $days;
	public $count;
	public $rent_type = 0;

	public function rules()
	{
		return array(
			array('days, type, count, location, pick_date', 'required'),
			array('count, days, rent_type', 'numerical', 'integerOnly'=>true),
		);
	}

	public function attributeLabels()
	{
		return array(
			'location'=> Yii::t('search', 'location'),
			'type' => Yii::t('search', 'type'),
			'days' => Yii::t('search', 'days'),

			'pick_date' => Yii::t('search', 'pick_date'),
// 			'return_date' => Yii::t('search', 'return_date'),
			'count' => Yii::t('search', 'count'),
		);
	}
	
	public function getDetails()
	{
		$types = School::getSurfTypes();
		$res = array(
			array('name' => Yii::t('search', 'type'), 'value' => $types[$this->type]),
			array('name' => Yii::t('search', 'pick_date'), 'value' => $this->pick_date),
			array('name' => Yii::t('search', 'days'), 'value' => $this->days),
			array('name' => Yii::t('search', 'count'), 'value' => $this->count),
		);
		if ($this->type == 'kite' || $this->type == 'wind')
		{
			$types = $this->rentTypes($this->type);
			$res [] = array('name' => Yii::t('app', 'rent_type'), 'value' => $types[$this->rent_type]);
		}
		
		
		
		return $res;
	}
	
	public function rentTypes($type)
	{
		$kite = Yii::t('search', 'kite');
		$wing = Yii::t('search', 'wing');
		$board = Yii::t('search', 'board');
		
		$addon = $type == 'kite' ? $kite : $wing;
		
		return array(
			0 => "$board+$addon",
			1 => "$board",
			2 => "$addon",
		);
	}
}