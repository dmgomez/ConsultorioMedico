<?php
$this->breadcrumbs=array(
	'Nacionalidads'=>array('index'),
	$model->nacionalidad_id,
);

$this->menu=array(
	array('label'=>'List Nacionalidad','url'=>array('index')),
	array('label'=>'Create Nacionalidad','url'=>array('create')),
	array('label'=>'Update Nacionalidad','url'=>array('update','id'=>$model->nacionalidad_id)),
	array('label'=>'Delete Nacionalidad','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->nacionalidad_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nacionalidad','url'=>array('admin')),
);
?>

<h1>View Nacionalidad #<?php echo $model->nacionalidad_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'nacionalidad_id',
		'descripcion_nacionalidad',
	),
)); ?>
