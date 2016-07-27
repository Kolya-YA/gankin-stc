<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta charset="utf-8">
	<meta name="format-detection" content="telephone=no" />
	<meta name='yandex-verification' content='4d0a9a62866bb28c' />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" media="screen" href="/css/fonts.css">
	<link rel="stylesheet" type="text/css" media="screen" href="/css/slider.css">
	<link rel="stylesheet" type="text/css" media="screen" href="/css/jqtransform.css">
	<link rel="stylesheet" type="text/css" media="screen" href="/css/jqtransform-2.css">
	<link rel="stylesheet" type="text/css" media="screen" href="/css/style.css">
	<link rel="stylesheet" type="text/css" href="/css/datepicker.css"> 
	<link rel="stylesheet" href="/css/buttons.css" type="text/css" />
<!-- 	<link rel="icon" href="images/favicon.ico" type="image/x-icon"> -->
<!-- 	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" /> -->
	<script src="/js/jquery-1.7.1.min.js"></script>
	<script src="/js/jquery.cookie.js"></script>
	<script src="/js/jquery.easing.1.3.js"></script>
	<script src="/js/superfish.js"></script>
	<script src="/js/jquery.jqtransform.js"></script>
	<script src="/js/camera.js"></script>
	<script src="/js/jquery.hoverIntent.minified.js"></script>
	<!--[if (gt IE 9)|!(IE)]><!-->
	<script type="text/javascript" src="/js/jquery.mobile.customized.min.js"></script>
	<!--<![endif]-->
	<script src="/js/jquery.ui.totop.js"></script>
	<script src="/js/jquery.mobilemenu.js"></script>
	<script src="/js/script.js"></script>
	<script src="/js/jquery.datepicker.min.js"></script>
	<script src="/js/common.js"></script>
	<script>
		$(window).load(function(){
			$().UItoTop({ easingType: 'easeOutQuart', text: "<?=Yii::t('app','top')?> &#x25B2;"});
		});
	</script>
	<!--[if lt IE 8]>
	<div style=' clear: both; text-align:center; position: relative;'>
		<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
		<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
		</a>
	</div>
	<![endif]-->
	<!--[if lt IE 9]>
	<link href='http://fonts.googleapis.com/css?family=Orbitron:400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Orbitron:700' rel='stylesheet' type='text/css'>
	<script src="/js/html5.js"></script>
	<link rel="stylesheet" href="/css/ie.css"> 
	<![endif]-->
  
  <?php
    $LastModified_unix = strtotime(date("D, d M Y H:i:s", filectime($_SERVER['SCRIPT_FILENAME'])));
    $LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
    $IfModifiedSince = false;

    if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
       $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));

    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
       $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));

    if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
       header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
       exit;
    }

    header('Last-Modified: '. $LastModified);
  ?>
</head>
<body>
	<div class="main">
	<!-- Header -->
		<div class="container_12">
		<article class="grid_12">
			<div class="inner-block">
				<header>
					<div class="header-block">
						<span class="fleft"><?=Yii::t('app', 'address')?></span>
						<div  class="fright form-style">
							<span class="links"><a href="/faq"><?=Yii::t('app', 'faq')?></a></span>
							<?=$this->renderPartial('/blocks/lang', array('lang' => Yii::app()->language))?>
							<span class="phone"><?=Yii::t('app', 'phone')?></span>
						</div>
						<div class="clear"></div>
					</div>
					<h1><a class='logo' href="/">Exclusive </a></h1>
					<nav>
						<? $this->widget('application.widgets.Menu', array(
							'items'=>array(
								array('label'=>Yii::t('menu','home'), 'url'=>'/'),
								array('label'=>Yii::t('menu','school'), 'url'=>'/school'),
								array('label'=>Yii::t('menu','equipment'), 'url'=>'/equipment'),
								array('label'=>Yii::app()->user->name.'<strong>('.Yii::t('auth', 'logout').')</strong>', 'url'=>'/logout', 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>Yii::t('menu','login'), 'url'=>'/login', 'visible'=>Yii::app()->user->isGuest),
								array('label'=>Yii::t('menu','contacts'), 'url'=>'/contacts'),
							),
							'activeCssClass' => 'current',
							'htmlOptions' => array('class' => 'sf-menu responsive-menu'),
							'activateItems' => true,
							'encodeLabel' => false,
						));?>
						<div class="clear"></div>
					</nav>
					<div class="clear"></div>
				</header>
			</div>
		</article>
		<div class="clear"></div>
		</div>
		<!-- Content -->
		<?=$content?>
		<!-- Footer -->
		<footer>
			<div class="container_12">
				<article class="grid_12">
					<div class="inner-block">
						<span class="copy"><?=$_SERVER['HTTP_HOST']?>  &copy; <?=date('Y')?>  </span>
						<a href="/rental"><?=Yii::t('app', 'rental_policies')?></a>&nbsp;
						<a href="/privacy"><?=Yii::t('app', 'privacy_policy')?></a>&nbsp;
						<a href="/faq"><?=Yii::t('app', 'faq')?></a>&nbsp;
						<a href="/partner"><?=Yii::t('app', 'become_partner')?></a>
						<a href="/impressum"><?=Yii::t('app', 'impressum')?></a>
						<? if (!Yii::app()->user->isGuest): ?>
						<a href="/userpanel"><?=Yii::t('menu','userpanel')?></a>
						<? endif ?>
						<div class="phone"><?=Yii::t('app', 'phone')?></div>
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</footer>
		<!-- Footer -->
	</div>
	
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-44703424-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>	
  
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-60737022-1', 'auto');
    ga('send', 'pageview');

  </script>
</body>
</html>
