<?php

class SchoolController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
    public $banners = []; //Banners block for view in innerFlex

	/**
	 * @return array action filters
	 */
	public function filterOwnerOnly($filterChain)
	{
		if (Yii::app()->user->role != 'admin')
		{
			$school = School::model()->findByPk($this->actionParams['id']);
			if (!$school)
				throw new CHttpException(404);
			if (Yii::app()->user->id != $school->user_id)
				throw new CHttpException(403);
		}
		
		$filterChain->run();
	}

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'ownerOnly + update',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('equipment','view','index', 'order', 'kite_schools_in_tarifa'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('update'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('settings'),
				'roles'=>array('school'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create', 'admin', 'delete'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout = 'inner';
		$this->render('view',array(
			'school'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($scenario=false)
	{
		$model=new School($scenario);

		foreach (School::getSurfTypes() as $k=>$v)
		{
			$model->branches[$k] = new SchoolBranch;
			foreach (School::getLessonTypes() as $lk => $lv)
				foreach (School::getDurations() as $dk => $dv)
					$model->prices[$k][$lk][$dk] = new SchoolPrice;
		}
		
		if(isset($_POST['School']))
		{
			$model->attributes=$_POST['School'];
			
			foreach (School::getSurfTypes() as $k=>$v)
			{
				$model->branches[$k]->attributes = $_POST['branches'][$k];
				foreach (School::getLessonTypes() as $lk => $lv)
					foreach (School::getDurations() as $dk => $dv)
						$model->prices[$k][$lk][$dk]->attributes = $_POST['prices'][$k][$lk][$dk];
			}
			
			if (isset($_POST['branch']))
				$model->branch = $_POST['branch'];
			
			if($model->save())
			{
				if (Yii::app()->user->role == 'admin')
					$this->redirect(array('admin','id'=>$model->id));
				else
					$this->redirect(array('/admin'));
			}
			else
				$model->preloadMultilang();
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
		foreach (School::getSurfTypes() as $k=>$v)
		{
			$branch = SchoolBranch::model()->find(
				'school_id = :id AND type = :type', 
				array('id' => $model->id, 'type' => $k)
			);
			$model->branches[$k] = $branch ? $branch : new SchoolBranch;

			foreach (School::getLessonTypes() as $lk => $lv)
				foreach (School::getDurations() as $dk => $dv)
				{
					$price = SchoolPrice::model()->find(
						'school_id = :id AND type = :type AND lesson_type = :lt AND duration = :duration', 
						array(
							'id' => $model->id, 
							'type' => $k,
							'lt' => $lk,
							'duration' => (string)$dk,
						)
					);
					$model->prices[$k][$lk][$dk] = $price ? $price : new SchoolPrice;
				}
		}
// 		D::dump($model->prices);

		if(isset($_POST['School']))
		{
			$model->attributes=$_POST['School'];
			
			foreach (School::getSurfTypes() as $k=>$v)
			{
				$model->branches[$k]->attributes = $_POST['branches'][$k];
				
				foreach (School::getLessonTypes() as $lk => $lv)
					foreach (School::getDurations() as $dk => $dv)
						$model->prices[$k][$lk][$dk]->attributes = $_POST['prices'][$k][$lk][$dk];
			}
			if (isset($_POST['branch']))
				$model->branch = $_POST['branch'];
			
			if($model->save())
			{
				if (Yii::app()->user->role == 'admin')
					$this->redirect(array('admin','id'=>$model->id));
			}
			$model->preloadMultilang();
		}
		else
			$model->preloadMultilang();
			
// 		D::dump($model->prices);
// 		D::dump($model->branches);

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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new School('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['School']))
			$model->attributes=$_GET['School'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return School the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=School::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param School $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'school-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSettings()
	{
		$school = School::model()->find('user_id = :uid', array('uid' => Yii::app()->user->id));
		if (!$school)
			return $this->actionCreate('school');
		else
			return $this->actionUpdate($school->id);
	}

	public function actionIndex()
	{
		$this->layout = 'inner';

		$filter = false;
		$results = null;
		
		$model=new SchoolForm;

        $model->date_from = date('Y-m-d', time() + (7 * 24 * 60 * 60));
        $model->date_to = date('Y-m-d', time() + (21 * 24 * 60 * 60));

		if(isset($_GET['area']))
			$model->location = intval($_GET['area']);

		if(isset($_POST['SchoolForm']))
		{
			$model->attributes = $_POST['SchoolForm'];
			if($model->validate())
			{
				$results = School::findCourse($model);
				if ($results)
				{
					$filter = time().rand(100, 999);
					$_SESSION['crit'][$filter] = $model;
				}
			}
		}
		else
			$model->amount = 1;
		if (!$results)
		{
// 			$results = School::model()->findAll(array('order' => 'rand()', 'limit' => 20));
			$banners_left = Banner::model()->findAll('left_course = 1');
		}
		else
			$banners_left = Banner::model()->findAll('search_result = 1');
		
// 		D::dump($results);
		
		$banners_right = Banner::model()->findAll('right_course = 1');
		
		$page = Page::model()->find('slug = \'school\'');

		$this->render('school', array(
			'model' => $model,
			'schools' => $results,
			'filter' => $filter,
			'banners_left' => $banners_left,
			'banners_right' => $banners_right,
			'page' => $page
		));
	}

//    Action kite_schools_in_tarifa()
    public function actionkite_schools_in_tarifa()
    {
        $this->layout = 'innerFlex';

        $criteria = new CDbCriteria();
        $count = School::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 10; //Schools pr page
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

        $results = School::model()->findAll($criteria);
        $page = Page::model()->find('slug = \'list-Of-Schools\'');
        $this->pageTitle = Lang::local($page->name) . ' | ' . Yii::app()->name ;
        $this->banners = Banner::model()->findAll([
                'limit'=>count($results),
                'order'=>'rand()',
            ]);

        $this->render('schoolList', [
            'schools' => $results,
            'page' => $page,
            'pagerSettings' => $pagerSettings,
        ]);
    }

	public function actionEquipment()
	{
		$this->layout = 'inner';
		
		$filter = false;
		$results = null;
		
		$model = new EquipmentForm;
		$model->pick_date = date('Y-m-d', time() + (7 * 24 * 60 * 60));

		if(isset($_GET['area']))
			$model->location = intval($_GET['area']);

		if(isset($_POST['EquipmentForm']))
		{
			$model->attributes=$_POST['EquipmentForm'];
			if($model->validate())
			{
				$results = School::findEquipment($model);
				if ($results)
				{
					$filter = time().rand(100, 999);
					$_SESSION['crit'][$filter] = $model;
				}
			}
		}
		else
			$model->count = 1;

		if (!$results)
		{
			$banners_left = Banner::model()->findAll('left_equipment = 1');
		}
		else
			$banners_left = Banner::model()->findAll('search_result = 1');

		$page = Page::model()->find('slug = \'equipment\'');
			
		$this->render('equipment', array(
			'model' => $model,
			'schools' => $results,
			'filter' => $filter,
			'banners_left' => $banners_left,
			'page' => $page
		));
	}
	
	public function actionOrder($id, $filter, $confirm = false, $percent = false)
	{
		$_SESSION['last_order_url'] = $_SERVER['REQUEST_URI'];
		
		$this->layout = 'inner';
		
		$model = new OrderForm;
		
		if ($_SERVER['REQUEST_METHOD'] == 'GET')
			$model->percent = true;
		
		if (!isset($_SESSION['crit'][$filter]))
			throw new CHttpException(404);
			
		$crit = $_SESSION['crit'][$filter];
		
		switch (get_class($crit))
		{
			case 'EquipmentForm':
				$schools = School::findEquipment($crit, $id);
				if ($schools)
				{
					$school = $schools[0];
					$type = 'equipment';
				}
				else
					throw new CHttpException(404);
			break;
			case 'SchoolForm':
				$schools = School::findCourse($crit, $id);
				if ($schools)
				{
					$type = 'course';
					$school = $schools[0];
				}
				else
					throw new CHttpException(404);
			break;
			default:
				throw new CHttpException(404);
		}
		if (isset($_POST['OrderForm']))
		{
			$model->attributes = $_POST['OrderForm'];
			if($model->validate())
			{
				$description = "Order $type";
				
				$price = $school->price;
				if ($model->percent)
				{
					$price *= .2;
					$description .= " (20%)";
				}
				
				
				/*
				
				$paymentInfo = array('Member'=> 
				array( 
					'first_name'=>$model->first_name, 
					'last_name'=>$model->last_name, 
					'billing_address'=>'', 
					'billing_address2'=>'', 
					'billing_country'=>'', 
					'billing_city'=>'', 
					'billing_state'=>'', 
					'billing_zip'=>'' 
				), 
				'CreditCard'=> 
				array( 
					'card_number'=>$model->card_number,//'4527161245087834', 
					'expiration_month'=>$model->expiration_month, 
					'expiration_year'=>$model->expiration_year, 
					'cv_code'=>$model->cv_code,
					'credit_type'=>'',
				), 
				'Order'=> 
				array('theTotal'=>$price) 
				); 
				
				
				$result = Yii::app()->Paypal->DoDirectPayment($paymentInfo); 
				
// 				print "<xmp>";
// 				print_r($result);
//                                 print "</xmp>";
//                                 exit;
				
				//Detect Errors 
				if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
					if(Yii::app()->Paypal->apiLive === true){
						//Live mode basic error message
						$error = 'We were unable to process your request. Please try again later';
					}else{
						//Sandbox output the actual error message to dive in.
						$error = $result['L_LONGMESSAGE0'];
					}
					
					$error = $result['L_LONGMESSAGE0']; // Don't care
					echo $error;
					
					
					
				}else { 

					$transaction = new Transaction;
					
					$transaction->school_id = $school->id;
					$transaction->user_id = Yii::app()->user->id;
// 					$transaction->token = $token;
					$transaction->amount = $price;
					$transaction->details = $crit->formatDetails();
					$transaction->full = (int)(!$model->percent);
					$transaction->type = $crit->type;
					$transaction->subject = $type;
					$transaction->confirmed = 1;
					
					$transaction->save();
					
					$_SESSION['lastTransaction'] = $transaction->id;
					MailNotifier::notify($transaction->id);

					//exit; // TODO REMOVE
					$this->redirect('/paypal/success');
				}
				*/
				
				$transaction = new Transaction;
					
				$transaction->description = $description;
				$transaction->school_id = $school->id;
				$transaction->user_id = Yii::app()->user->id;
				$transaction->amount = $price;
				$transaction->details = $crit->formatDetails();
				$transaction->full = (int)(!$model->percent);
				$transaction->type = $crit->type;
				$transaction->subject = $type;
				$transaction->confirmed = 0;
				
				$transaction->save();
				
				$this->render('/payment/posh/form', array(
					'transaction' => $transaction,
				));

				Yii::app()->end();
			}
		}
		
		else if (isset($_POST['paypal']))
		{
			$price = $school->price;
			$description = "Order $type";			
			
			if (isset($_POST['percent'])) {
				$price *= .2;
				$description .= " (20%)";
			}
			
			$paymentInfo['Order']['description'] = $description;
			$paymentInfo['Order']['theTotal'] = $price;
			$paymentInfo['Order']['quantity'] = '1';

			$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo); 
			//Detect Errors 
			if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
				if(Yii::app()->Paypal->apiLive === true){
					//Live mode basic error message
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
					$error = $result['L_LONGMESSAGE0'];
				}
				echo $error;
				Yii::app()->end();
				
			}else { 
				// send user to paypal 
				$token = urldecode($result["TOKEN"]); 
				
				$transaction = new Transaction;
				
				$transaction->school_id = $school->id;
				$transaction->user_id = Yii::app()->user->id;
				$transaction->token = $token;
				$transaction->amount = $price;
				$transaction->description = $description;
				$transaction->details = $crit->formatDetails();
				$transaction->full = (int)(!$percent);
				$transaction->type = $crit->type;
				$transaction->subject = $type;
				
				$transaction->save();
				
				$payPalURL = Yii::app()->Paypal->paypalUrl.$token; 
				$this->redirect($payPalURL); 
			}
		}
		
		$banners = Banner::model()->findAll('payment = 1');
		
		$this->render('order', array(
			'school' => $school,
			'details' => $crit->getDetails(),
			'type' => $type,
			'filter' => $filter,
			'model' => $model,
			'banners' => $banners,
			));
	}
}