<?

class ActiveRecord extends CActiveRecord
{
	protected $multilang = array();
	protected $sets = array();
	
	protected function beforeValidate(){
		if(!parent::beforeValidate())
			return false;
		foreach($this->multilang as $field) 
		{
			$val = $this->attributes[$field];
			foreach ($val as $k => $v)
			{
				if (trim(strip_tags($v)) == '')
					unset($val[$k]);
			}
			if (!$val)
				$val = false;
			else
				$val = json_encode($val/*, JSON_UNESCAPED_UNICODE*/);
			$this->$field = $val;
		}
		foreach($this->sets as $field) 
		{
			if (is_array($this->$field))
				$this->$field = implode(',', $this->$field);
		}
		
		foreach ($this->rules() as $rule)
		{
			if ($rule[1] == 'file')
			{
				$fields = explode(', ', $rule[0]);
				foreach ($fields as $field)
				{
					$class = get_class($this);
					if (isset($_POST[$class]["{$field}_delete"]))
					{
						Upload::deleteUpload($this->$field);
						$this->$field = false;
					}
					if ($file = CUploadedFile::getInstance($this, $field))
					{
						if ($this->$field)
						{
							$path = Yii::getPathOfAlias('uploads').DIRECTORY_SEPARATOR.$this->$field;
							if (file_exists($path))
								unlink($path);
						}
					
						list($shortname, $filename) = Upload::uniqueUploadName($file->name);

						$file->saveAs($filename);
						$this->$field=$shortname;
					}
				}
			}
		}

		return true;
	}
	
	public function preloadMultilang()
	{
		foreach($this->multilang as $field) 
		{

			//D::dump($this->$field);
			$this->$field = json_decode($this->$field, true);
		}
		foreach($this->sets as $field) 
		{
			$this->$field = explode(',', $this->$field);
		}
	}
}