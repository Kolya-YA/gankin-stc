<?

Yii::import('zii.widgets.grid.CGridColumn');

class MultilangColumn extends CDataColumn
{
	protected function renderDataCellContent($row,$data)
	{
		echo Lang::def($data->{$this->name});
	}
}
