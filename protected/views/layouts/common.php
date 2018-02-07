<!DOCTYPE html>
<html lang="<?=Yii::t('app', 'current_lang')?>">
<head>
    <?=  $this->renderPartial('/blocks/gTag') ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<meta charset="utf-8">
	<meta name="format-detection" content="telephone=no">
	<meta name="yandex-verification" content="fe58b273fa9740d3">
    <meta name="msvalidate.01" content="27952050F8E1BD939DF369ECE80068D7" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <? foreach (Lang::getSiteLangs() as $code => $name): ?>
    <link rel="alternate" hreflang="<?=$code?>" href="<?=Lang::getCurrentUrl($code)?>">
    <? endforeach ?>

	<link rel="stylesheet" type="text/css" media="screen" href="/css/main.min.css">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<script src="/js/jquery-3.2.1.min.js"></script>
	<script src="/js/jquery.cookie.js"></script>

	<!-- <script src="/js/script.js"></script> -->
	<script src="/js/common.js"></script>

<!--Cookie alert-->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <script async src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function(){
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#eb6c44",
                        "text": "#ffffff"
                    },
                    "button": {
                        "background": "#f5d948"
                    }
                },
                "theme": "edgeless"
            })});
    </script>
<!--/Cookie alert-->

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
        <?=  $this->renderPartial('/blocks/yaMetrika') ?>

        <?=  $this->renderPartial('/blocks/header') ?>

		<?=$content?>

        <?=  $this->renderPartial('/blocks/footer') ?>

		<div id="arrowToTop" hidden>△</div>

</body>
</html>