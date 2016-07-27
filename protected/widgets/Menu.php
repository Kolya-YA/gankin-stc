<?
class Menu extends CMenu
{
	protected function isItemActive($item,$route)
	{
		$url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '/';
		return ($url == $item['url']);
	}
}