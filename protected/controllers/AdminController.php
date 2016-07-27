<?

class AdminController extends CController
{
	public $layout='//layouts/column1';
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',
// 				'actions'=>array('*'),
// 				'users'=>array('admin'),
				'roles'=>array('admin', 'school'),

			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	
	function actionIndex()
	{
		$this->render('/admin/index');
	}
	
	function actionPayments()
	{
		$model=new TransactionForm();

		$results = null;
		
		if(isset($_GET['TransactionForm']))
		{
			$model->attributes=$_GET['TransactionForm'];
			$results = $model->findTransactions();
		}

		$this->render('transactions',array(
			'model'=>$model,
			'results'=>$results,
		));
	}
}
