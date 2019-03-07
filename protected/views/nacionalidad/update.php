<?php
$this->breadcrumbs=array(
	'Nacionalidads'=>array('index'),
	$model->nacionalidad_id=>array('view','id'=>$model->nacionalidad_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Nacionalidad','url'=>array('index')),
	array('label'=>'Create Nacionalidad','url'=>array('create')),
	array('label'=>'View Nacionalidad','url'=>array('view','id'=>$model->nacionalidad_id)),
	array('label'=>'Manage Nacionalidad','url'=>array('admin')),
);
?>

<h1>Update Nacionalidad <?php echo $model->nacionalidad_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>