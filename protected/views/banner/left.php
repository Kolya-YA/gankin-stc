<section class="banner-left-block">
<?
foreach ($banners as $banner)
    $this->renderPartial('/banner/index', array('banner' => $banner, 'pic_width' => 150, 'pic_height' => 200));
?>
</section>