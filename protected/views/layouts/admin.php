<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<script src="/js/jquery.min.js"></script>
	<script src="/js/tinymce/tinymce.min.js"></script>
	<script src="/js/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="/js/admin.js"></script>

<!--	<link rel="stylesheet" type="text/css" href="/css/datepicker.css"> -->
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php 
		$items = array();
		
		if (Yii::app()->user->role == 'admin')
			$items = array(
				array('label'=>'News', 'url'=> array('/news/admin')),
				array('label'=>'Pages', 'url'=> array('/page/admin')),
				array('label'=>'Banners', 'url'=> array('/banner/admin')),
				array('label'=>'Translations', 'url'=> array('/TranslatePhpMessage')),
				array('label'=>'Users', 'url'=> array('/user/admin')),
				array('label'=>'Locations', 'url'=> array('/location/admin')),
				array('label'=>'Languages', 'url'=> array('/lang/admin')),
				array('label'=>'Manage schools', 'url'=> array('/school/admin')),
            );
		if (Yii::app()->user->role == 'school')
			$items[] = array('label'=>'School info', 'url'=>array('/school/settings'));
		if (Yii::app()->user->role == 'school' || Yii::app()->user->role == 'admin')
			$items[] = array('label'=>'Manage courses', 'url'=>array('/course/admin'));
			
		$items[] = array('label'=>'Payments', 'url' => array('/admin/payments'));
		if (Yii::app()->user->isGuest)
			$items[] = array('label'=>'Login', 'url'=>array('/site/login'));
		else
			$items[] = array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'));
		$this->widget('zii.widgets.CMenu', array('items' => $items));
		?>
	</div><!-- mainmenu -->

	<?php if(isset($this->breadcrumbs)):?>
		<?php 
// 		$this->widget('zii.widgets.CBreadcrumbs', array(
// 			'links'=>$this->breadcrumbs,
// 		)); 
		?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?=date('Y');?> —
<!--        --><?php //by <a href="http://indexium.ru">Indexium</a>?>
		<?=Yii::powered()?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
