<?php
/**
 * @var $news object news content
 */
Yii::app()->clientScript->registerMetaTag(Lang::local($news->description), 'description');
Yii::app()->clientScript->registerMetaTag(Lang::local($news->keywords), 'keywords');

$this->params['pageLink'] = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//    $this->params['pageDescription']  = json_decode($news->description)->{'en'};

$pageLink = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$header = Lang::local($news->name);
$dateCreated = strtotime($news->created);
$description = Lang::local($news->description);

$ldjson = [
    "@context" => "http://schema.org",
    "@type" => "NewsArticle",
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id" => $pageLink
    ],
    "headline" => $header,
    "image" => ["https://surf-tarifa.com/images/logo.png"],
    "datePublished" => date('c', $dateCreated),
    "dateModified" => date('c', $dateCreated),
    "author" => [
        "@type" => "Organization",
        "name" => "Surf Tarifa Team"],
    "publisher" => [
        "@type" => "Organization",
        "name" => "surf-tarifa.com",
        "logo" => [
            "@type" => "ImageObject",
            "url" => "https://surf-tarifa.com/images/logo.png"
        ]
    ],
    "description" => $description
];

Yii::app()->clientScript->registerScript('aa', json_encode($ldjson), CClientScript::POS_HEAD, ['type' => 'application/ld+json']);

?>

<div class="inner-page">
    <div class="inner-page__page-content">
        <h2 class="inner-page__header"><?= $header ?></h2>
        <time class="inner-page__date"
              datetime="<?= date('Y-m-d', strtotime($news->created)) ?>"><?= date('d.m.Y', $dateCreated) ?></time>
        <?= Lang::local($news->content) ?>

        <?= $this->renderPartial('/blocks/likesBlock') ?>

        <a href="/news" class=""><?= Yii::t('app', 'seeall') ?></a>

    </div>
</div>