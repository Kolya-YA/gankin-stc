<?

class TransactionForm extends CFormModel
{
	public $school;
	public $date_from, $date_to;
	
	public $full;
	public $subject;
	public $type;
	
	public function rules()
	{
		return array(
			array('school, full, subject, type, date_from, date_to', 'safe'),
		);
	}


	public function attributeLabels()
	{
		return array(
			'date_form' => 'Date from',
			'date_to' => 'Date to',
			'full' => '100%',
			'subject' => 'course/equipment',
		);
	}
	
	public function findTransactions()
	{
		$criteria = new CDbCriteria();
		
		$criteria->compare('confirmed', 1);
		
		if ($this->type != null)
			$criteria->compare('type', $this->type);
		if ($this->subject != null)
			$criteria->compare('subject', $this->subject);
		if ($this->full != null)
			$criteria->compare('full', $this->full);
		if ($this->school != null)
			$criteria->compare('school_id', $this->school);
		
		if ($this->date_from != null)
			$criteria->compare('DATE(timestamp)', '>='.$this->date_from, false);

		if ($this->date_to != null)
			$criteria->compare('DATE(timestamp)', '<='.$this->date_to, false);
		
		return Transaction::model()->findAll($criteria);
	}
}