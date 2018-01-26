<?

class Upload extends CComponent
{
	static function uniqueUploadName($shortname)
	{
		$filename = Yii::getPathOfAlias('uploads').DIRECTORY_SEPARATOR.$shortname;
		if (file_exists($filename))
		do {
			$shortname = rand(1000, 10000).'_'.$shortname;
			$filename = Yii::getPathOfAlias('uploads').DIRECTORY_SEPARATOR.$shortname;
			if (!file_exists($filename))
				break;
		} while (true);
		return array($shortname, $filename);
	}
	static function deleteUpload($name)
	{
		$filename = Yii::getPathOfAlias('uploads').DIRECTORY_SEPARATOR.$name;
		if (file_exists($filename))
			unlink($filename);
	}
}