<?php
/* @var $this LangController */
/* @var $model Lang */

$this->breadcrumbs=array(
	'Langs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Lang', 'url'=>array('admin')),
);
?>

<h1>Create Lang</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>