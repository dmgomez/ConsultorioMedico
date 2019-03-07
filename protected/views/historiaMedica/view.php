<?php
$this->breadcrumbs=array(
	'Historia Medicas'=>array('index'),
	$model->historia_medica_id,
);

$this->menu=array(
	array('label'=>'List HistoriaMedica','url'=>array('index')),
	array('label'=>'Create HistoriaMedica','url'=>array('create')),
	array('label'=>'Update HistoriaMedica','url'=>array('update','id'=>$model->historia_medica_id)),
	array('label'=>'Delete HistoriaMedica','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->historia_medica_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HistoriaMedica','url'=>array('admin')),
);
?>

<h1>View HistoriaMedica #<?php echo $model->historia_medica_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'historia_medica_id',
		'paciente_id',
		'consulta_id',
		'referido',
	),
)); ?>
