<?php

class NewsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    public $banners = [];
    public $params = []; // additional parameters for passing to view

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return [
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
        ];
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return [
			['allow',
				'actions'=> ['index','view','NewsList'],
				'users'=> ['*'],
            ],
			['allow',
				'actions'=> ['create','update', 'admin','delete'],
				'roles'=> ['admin'],
            ],
			['deny',
				'users'=> ['*'],
            ],
        ];
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
        $this->pageTitle = Lang::local($model->name) . ' | ' . Yii::app()->name;

		$this->layout = 'innerFlex';

        $this->banners = Banner::model()->findAll([
            'limit'=> '2',
            'order'=>'rand()',
        ]);

        $this->render('view', [
			'news'=>$model,
        ]);
	}

//    Action News List()
    public function actionNewsList()
    {
        $this->layout = 'innerFlex';

        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $count = News::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 20; //Schools pr page
        $pages->applyLimit($criteria);

        $pagerSettings = [
            'pages' => $pages,
            'cssFile' => '',
            'htmlOptions' => ['class' => 'paginator'],
            'header' => '',
            'maxButtonCount' => 4, // MAX button in paginator
            'firstPageLabel' => '&laquo;&laquo;', // ««
            'firstPageCssClass' => 'paginator__first-page',
            'lastPageLabel' => '&raquo;&raquo;',  // »»
            'lastPageCssClass' => 'paginator__last-page',
            'prevPageLabel' => '&laquo;', // «
            'previousPageCssClass' => 'paginator__previous-page',
            'nextPageLabel' => '&raquo;',  // »
            'nextPageCssClass' => 'paginator__next-page',
            'internalPageCssClass' => 'paginator__page',
            'selectedPageCssClass' => 'paginator--selected',
            'hiddenPageCssClass' => 'paginator--hidden',
        ];

        $news = News::model()->findAll($criteria);
//        $this->pageTitle = 'All kitesurfing and windsurfing news from Tarifa | ' . Yii::app()->name;

//        $page = Page::model()->find('slug = \'all-news\'');
//        $page = Page::model()->find('id = 11');
        $page = Page::model()->find('slug = \'all-news\'');
//        print D::dump($page);
        $this->pageTitle = Lang::local($page->name) . ' | ' . Yii::app()->name;

        $this->banners = Banner::model()->findAll([
            'limit'=>count($news),
            'order'=>'rand()',
        ]);

        $this->render('index', [
            'results' => $news,
            'page' => $page,
            'pagerSettings' => $pagerSettings,
        ]);
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new News;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
			else
				$model->preloadMultilang();
		}
		else 
		{
			$model->created = date('Y-m-d H:i:s');
		}
		

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->preloadMultilang();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
			else
				$model->preloadMultilang();
		}
				

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('News');
//        $this->layout = 'inner';
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
