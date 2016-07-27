<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	protected $print;
	
	protected function beforeAction($action)
	{
		if (Yii::app()->user->role == 'admin' && isset($_GET['debug']))
			Yii::app()->getComponent('messages')->debug = true;
// 		$cs=Yii::app()->clientScript;
// 		$cs->scriptMap=array(
// 			'jquery.js'=> '/js/jquery-1.7.1.min.js',
// 			);
	
		if (preg_match('/^(www\.)?(?P<lang>\w\w)\./', $_SERVER['HTTP_HOST'], $matches))
		{
			$lang = $matches['lang'];
		}
		else
		{
			$lang = 'en';
		}
		/*	
		$lang = Yii::app()->request->cookies['lang'];
		
		if ($lang)
		{
			$lang = $lang->value;
		}
		else
		{
			$lang = 'en';
		}*/
		Yii::app()->setLanguage($lang);
		return parent::beforeAction($action);
	}
	protected function beforeRender($view)
	{
		if (isset($_GET['print']))
		{
			$this->print = true;
			$this->layout = 'print';
		}
		
		if (isset($_GET['debug']))
		{
			print_r($_SESSION);
		}
			
		return parent::beforeRender($view);
	}
}