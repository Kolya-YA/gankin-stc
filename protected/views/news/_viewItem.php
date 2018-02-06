<?php
/**
 * Created by PhpStorm.
 * User: kolya_ya
 * Date: 05.02.2018
 * Time: 14:23
 */


/* @var $this NewsController */
/* @var $result News */
?>

<article class="article-card main-content--border">

    <div class="article-card__header">
        <h3 class="article-card__name"><?php echo CHtml::encode(Lang::local($result->name)); ?></h3>
    </div>

    <div class="article-card__content">
        <p><?php echo CHtml::encode(Lang::local($result->description)); ?></p>
    </div>

    <div>
        <b><?php echo CHtml::encode($result->getAttributeLabel('id')); ?>:</b>
	    <?php echo CHtml::link(CHtml::encode($result->id), array('view', 'id'=>$result->id)); ?>
    </div>
	<div><?php echo CHtml::encode(date('d.m.Y', strtotime($result->created))); ?></div>

	<?php echo CHtml::link(Yii::t('app', 'details'), ['view', 'id'=>$result->id], ['class' => 'button']); ?>

</article>