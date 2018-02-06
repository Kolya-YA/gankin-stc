<?php
/**
 * @var $school object  data for school card display
 */
?>

    <article class="article-card main-content--border">
        <div class="article-card__header">
            <h3 class="article-card__name"><?= Lang::local($school->name) ?></h3>
            <div class="article-card__year">Since: <?= $school->year ?></div>
        </div>
        <div class="article-card__content">
            <div class="article-card__image">
                <img class="school-card__photo"
                     src="<?= AutoThumb::url('/media/' . $school->picture, 320, 240) ?>"
                     alt="<?= Lang::local($school->name) ?>">
            </div>
            <p class="article-card__description"><?= Lang::local($school->short_description) ?></p>
                <?php if ($school->branches): ?>
                    <div class="article-card__service-types">
                        <?php foreach ($school->branches as $item => $value): ?>
                            <div class="article-card__service-item"><?= School::getSurfTypes()[$value->type]; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
        </div>
        <a class="school-card_button button" href="/school/<?=$school->id?>"><?=Yii::t('app', 'details')?></a>
    </article>