<?

class D extends CComponent
{
	static public function dump($var, $level = 10, $highlight = true)
	{
		return CVarDumper::dump($var, $level, $highlight);
	}
	static public function trace($var, $level = 10, $highlight = true)
	{
		return Yii::trace(CVarDumper::dumpAsString($var, $level, $highlight));
	}
}