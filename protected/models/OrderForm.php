<?

class OrderForm extends CFormModel
{
	public $first_name, $last_name;

	public $card_number;
	public $expiration_month;
	public $expiration_year;
	public $cv_code;
	public $percent;
	public $accept;
	
	public function rules()
	{
		return array(
			//array('first_name, last_name, card_number, expiration_month, expiration_year, cv_code, percent', 'required'),
			array('percent', 'safe'),
			array('accept', 'compare', 'compareValue' => '1', 'message' => Yii::t('app', 'Read and accept terms & conditions')),
		);
	}


	public function attributeLabels()
	{
		return array(
			'first_name' => Yii::t('app', 'First name'),
			'last_name' => Yii::t('app', 'Last name'),
			'percent' => Yii::t('app', 'Pay 20%').'<sup>*</sup>',
			'accept' => Yii::t('app', 'accept'),

			'card_number' => Yii::t('app', 'Credit card number'),
			'expiration_month' => Yii::t('app', 'Expiration month'),
			'expiration_year' => Yii::t('app', 'Expiration year'),
			'cv_code' => Yii::t('app', 'CVV'),
		);
	}
	
	public static function months()
	{
		static $result = array();
		
		if (empty($result))
		{
			for ($i = 1; $i <= 12; $i++)
			{
			$month = sprintf('%02d', $i);
			$result[$month] = $month;
			}
		}
		
		return $result;
	}
	
        public static function years()
        {
		static $result = array();
		
		if (empty($result))
		{
			$year = date('Y');
			for ($i = 1; $i <= 15; $i++)
			{
				$result[$year] = $year;
				$year++;
			}
		}
		
		return $result;
        }
}