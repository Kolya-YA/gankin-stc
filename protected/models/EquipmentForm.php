<?

class EquipmentForm extends FilterForm
{
	public $type;
	public $pick_date;
	public $days;
	public $count;
	public $rent_type = 0;
	public $location;

	public function rules()
	{
		return array(
			array('days, type, count, location, pick_date', 'required'),
			array('count, days, rent_type', 'numerical', 'integerOnly'=>true),
			array('pick_date', 'type', 'type' => 'date', 'dateFormat' => 'yyyy-MM-dd'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'location' => Yii::t('search', 'location'),
			'type' => Yii::t('search', 'type'),
			'pick_date' => Yii::t('search', 'pick_date'),
			'days' => Yii::t('search', 'days'),
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

    /**
     * @return array with html options for Radio button block in search form.
     */
    public function radioOptions()
    {
        return [
            'container' => 'div class="radio-block"',
            'template' => '{beginLabel}{input}{labelTitle}{endLabel}',
            'separator' => '',
            'uncheckValue' => null,
            'disabled' => 1
        ];
    }

    public function datePickerOptions()
    {
        return [
            'min' => date('Y-m-d'),
            'max' => date('Y-m-d', time() + (365 * 24 * 60 * 60)),
            'required' =>  true
        ];
    }

	public function rentTypes($type)
	{
		$kite = Yii::t('search', 'kite');
		$wing = Yii::t('search', 'wing');
		$board = Yii::t('search', 'board');

		$addon = $type === 'kite' ? $kite : $wing;
		
		return [
			0 => "$board & $addon",
			1 => "$board",
			2 => "$addon",
        ];
	}
}