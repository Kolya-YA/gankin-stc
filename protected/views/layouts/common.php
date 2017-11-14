<!DOCTYPE html>
<html lang="<?=Yii::t('app', 'current_lang')?>">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta charset="utf-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="yandex-verification" content="fe58b273fa9740d3" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<? foreach (Lang::getSiteLangs() as $code => $name): ?>
	<link rel="alternate" hreflang="<?=$code?>" href="<?php echo Lang::getCurrentUrl($code)?>">
	<? endforeach ?>
	
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="/css/slider.css"> -->
	<link rel="stylesheet" type="text/css" media="screen" href="/css/jqtransform.css">
	<link rel="stylesheet" type="text/css" media="screen" href="/css/jqtransform-2.css">
	<link rel="stylesheet" type="text/css" media="screen" href="/css/main.min.css">

	<link rel="stylesheet" type="text/css" href="/css/datepicker.css"> 
	<link rel="stylesheet" href="/css/buttons.css" type="text/css">
<!-- 	<link rel="icon" href="images/favicon.ico" type="image/x-icon"> -->
<!-- 	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" /> -->
	<script src="/js/jquery-1.7.1.min.js"></script>
	<script src="/js/jquery.cookie.js"></script>
	<script src="/js/jquery.easing.1.3.js"></script>
	<script src="/js/jquery.jqtransform.js"></script>
	<script src="/js/camera.js"></script>
	<script src="/js/script.js"></script>
	<script src="/js/jquery.datepicker.min.js"></script>
	<script src="/js/common.js"></script>
	
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
			
		<header class="page-header header--closed">
			
			<button class="toggle-menu" type="button">
				<span class="toggle-menu__burger"></span>Menu
			</button>
			
			<div class="page-header__holder"></div>
			
			<nav class=top-nav>

				<div class="top-nav__topmenu">
					<div class="page-header__wrapper">
						
						<?=$this->renderPartial('/blocks/lang', array('lang' => Yii::app()->language))?>
						
						<? $this->widget('application.widgets.Menu', array(
							'items'=>array(
								array('label'=>Yii::t('auth', 'logout').' ('.Yii::app()->user->name.')', 'url'=>'/logout', 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'top-nav__logout')),
								array('label'=>Yii::t('menu', 'register'), 'url'=>'/register', 'visible'=>Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'top-nav__register')),
								array('label'=>Yii::t('menu', 'login'), 'url'=>'/login', 'visible'=>Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'top-nav__login'))
							),
							'activeCssClass' => 'current',
							'htmlOptions' => array('class' => 'top-nav__user'),
							'activateItems' => true,
							'encodeLabel' => false,
						));?>
						
					</div>
				</div>

				<div class="top-nav__logo">
					<div class="page-header__wrapper">
						<a class='top-nav__name' href="/">
							<h1>
								<img src="../images/logo.png" alt="surf-Tarifa.com logo" width="250">
								<span><?=Yii::t('app', 'header_h1')?></span>
							</h1>
						</a>
						<!-- <span class="phone"><?=Yii::t('app', 'phone')?></span> -->
					</div>
				</div>
					
				<div class="top-nav__menu">
					<div class="page-header__wrapper">
						<? $this->widget('application.widgets.Menu', array(
							'items'=>array(
								array('label'=>Yii::t('menu', 'home'),				'url'=>'/'),
								array('label'=>Yii::t('menu', 'aboutTarifa'),	'url'=>'/banner/1'),
								array('label'=>Yii::t('menu', 'schools'),			'url'=>'/school/7'),
								array('label'=>Yii::t('menu', 'school'),			'url'=>'/school'),
								array('label'=>Yii::t('menu', 'equipment'),		'url'=>'/equipment'),
								array('label'=>Yii::t('menu', 'faq'),					'url'=>'/faq'),
								array('label'=>Yii::t('menu', 'contacts'), 		'url'=>'/contacts')
							),
							'activeCssClass' => 'current',
							'htmlOptions' => array('class' => 'top-nav__list'),
							'activateItems' => true,
							'encodeLabel' => false,
						));?>
					</div>
				</div>

			</nav>
	
				<!-- Yandex.Metrika counter -->
				<script type="text/javascript" >
					(function (d, w, c) {
							(w[c] = w[c] || []).push(function() {
									try {
											w.yaCounter46536189 = new Ya.Metrika({
													id:46536189,
													clickmap:true,
													trackLinks:true,
													accurateTrackBounce:true
											});
									} catch(e) { }
							});

							var n = d.getElementsByTagName("script")[0],
									s = d.createElement("script"),
									f = function () { n.parentNode.insertBefore(s, n); };
							s.type = "text/javascript";
							s.async = true;
							s.src = "https://mc.yandex.ru/metrika/watch.js";

							if (w.opera == "[object Opera]") {
									d.addEventListener("DOMContentLoaded", f, false);
							} else { f(); }
					})(document, window, "yandex_metrika_callbacks");
			</script>
			<noscript><div><img src="https://mc.yandex.ru/watch/46536189" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
			<!-- /Yandex.Metrika counter -->

		</header>


		<?=$content?>


		<footer class="page-footer">
			
			<div class="page-footer__top">
				<div class="page-footer__wrapper">
					<div class="page-footer__nav">
						<a href="/rental"><?=Yii::t('app', 'rental_policies')?></a>
						<a href="/privacy"><?=Yii::t('app', 'privacy_policy')?></a>
						<a href="/faq"><?=Yii::t('app', 'faq')?></a>
						<a href="/partner"><?=Yii::t('app', 'become_partner')?></a>
						<a href="/impressum"><?=Yii::t('app', 'impressum')?></a>
						<? if (!Yii::app()->user->isGuest): ?>
						<a href="/userpanel"><?=Yii::t('menu','userpanel')?></a>
						<? endif ?>
					</div>
				</div>
			</div>
			
			<div class="page-footer__bottom">
				<div class="page-footer__wrapper">
					<div class="page-footer__contacts">
						<div class="copyright"><?=$_SERVER['HTTP_HOST']?>  &copy; <?=date('Y')?></div>
						<div class="address"><?=Yii::t('app', 'address')?></div>
						<div class="phone"><?=Yii::t('app', 'phone')?></div>
					</div>
				</div>
			</div>

		</footer>
	
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
	<script src="/js/jquery.ui.totop.js" async></script>
	<script src="/js/jquery.hoverIntent.minified.js" async></script>
	<script>
		$(window).load(function(){
			$().UItoTop({ easingType: 'easeOutQuart', text: "<?=Yii::t('app','top')?> &#x25B2;"});
		});
	</script>

	<script>	
		var headerSatus = document.querySelector('.page-header');
		var toggleBtn = document.querySelector('.toggle-menu');
	
		toggleBtn.addEventListener('click', function() {
			if (headerSatus.classList.contains('header--opened')) {
				headerSatus.classList.add('header--closed');
				headerSatus.classList.remove('header--opened');
			} else {
				headerSatus.classList.add('header--opened');
				headerSatus.classList.remove('header--closed');
			}
		});
	</script>
</body>
</html>