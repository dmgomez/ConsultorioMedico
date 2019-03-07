<?php
$this->breadcrumbs=array(
	'Historia Medica Consultas'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List HistoriaMedicaConsulta','url'=>array('index')),
	array('label'=>'Create HistoriaMedicaConsulta','url'=>array('create')),
	array('label'=>'Update HistoriaMedicaConsulta','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete HistoriaMedicaConsulta','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HistoriaMedicaConsulta','url'=>array('admin')),
);
?>

<h1>View HistoriaMedicaConsulta #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'consulta_id',
		'historia_medica_id',
		'parent_id',
		'title',
		'position',
		'tooltip',
		'url',
		'icon',
		'visible',
		'task',
	),
)); ?>
