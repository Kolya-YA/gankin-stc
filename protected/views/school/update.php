<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
// 	array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Create School', 'url'=>array('create')),
	array('label'=>'View School', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage School', 'url'=>array('admin')),
);
?>

<h1>Update School <?php echo $model->id; ?></h1>

<? if ($_SERVER['REQUEST_METHOD'] == 'POST'):?>
<div class="info-box">Updated</div>
<? endif ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>