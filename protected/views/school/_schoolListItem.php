<?php
/* @var $model School */
?>

    <article class="school-card main-content--border">
	    <h3 class="school-card__name"><?=Lang::local($school->name)?></h3>
	    <img class="school-card__photo" src="<?=AutoThumb::url('/media/'.$school->picture, 200, 150)?>" alt="<?=Lang::local($school->name)?>">
	    <p class="school-card__content"><?=Lang::local($school->short_description)?></p>
<?php foreach ($school->branches as $item => $value): ?>
    <?php
        $qwt = intval(json_decode($value->rent_prices, true)[0][3]);
        if ($qwt)
        {

    ?>

    <div>
<!--            --><?//=D::dump($value); ?>
    <?= School::getSurfTypes()[$value->type]; ?>
    <?= D::dump($qwt); ?>
    </div>

<?php  } endforeach;?>

        <p class="school-card__content"><?=$school->year?></p>
        <p class="school-card__content">
<!--            --><?//=D::dump($school); ?>
        </p>
        <p class="school-card__content">
<!--            --><?//=D::dump($school->typeOfSerf); ?>
<!--            --><?//=D::dump($school->branches); ?>
        </p>
        <p class="school-card__content">
<!--            --><?//=D::dump($school->branch); ?>
        </p>
        <a class="school-card_button button" href="/school/<?=$school->id?>"><?=Yii::t('app', 'details')?></a>
    </article>