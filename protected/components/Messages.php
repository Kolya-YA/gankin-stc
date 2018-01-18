<?

class Messages extends CPhpMessageSource
{
	public $debug = false;
	
	public function translate($category,$message,$language=null)
	{
		$message = parent::translate($category,$message,$language);
		if ($this->debug) {
			if (!$language)
				$language = 'en';
			$message .= "<a href='/TranslatePhpMessage/translate/translate/filename/$category.php/languageid/$language'>_</a>";
		}
		
		return $message;
	}
}