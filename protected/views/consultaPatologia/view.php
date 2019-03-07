<?php
$this->breadcrumbs=array(
	'Consulta Patologias'=>array('index'),
	$model->consulta_patologia_id,
);

$this->menu=array(
	array('label'=>'List ConsultaPatologia','url'=>array('index')),
	array('label'=>'Create ConsultaPatologia','url'=>array('create')),
	array('label'=>'Update ConsultaPatologia','url'=>array('update','id'=>$model->consulta_patologia_id)),
	array('label'=>'Delete ConsultaPatologia','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->consulta_patologia_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConsultaPatologia','url'=>array('admin')),
);
?>

<h1>View ConsultaPatologia #<?php echo $model->consulta_patologia_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'consulta_patologia_id',
		'consulta_id',
		'patologia_id',
	),
)); ?>
