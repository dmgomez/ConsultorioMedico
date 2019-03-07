<?php
$this->breadcrumbs=array(
	'Nacionalidads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Nacionalidad','url'=>array('index')),
	array('label'=>'Manage Nacionalidad','url'=>array('admin')),
);
?>

<h1>Create Nacionalidad</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>