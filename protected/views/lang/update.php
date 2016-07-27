<?php
/* @var $this LangController */
/* @var $model Lang */

$this->breadcrumbs=array(
	'Langs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Lang', 'url'=>array('create')),
	array('label'=>'Manage Lang', 'url'=>array('admin')),
);
?>

<h1>Update Lang <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>