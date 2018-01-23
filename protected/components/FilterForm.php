<?

abstract class FilterForm extends CFormModel
{
	abstract public function getDetails();
	public function formatDetails()
	{
		$details = $this->getDetails();
		$res = "";
		foreach ($details as $d)
		$res .= $d['name'] . ": " . $d['value'] . "\n";
		return $res;
	}
}