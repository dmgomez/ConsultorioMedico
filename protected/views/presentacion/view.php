<?php
$this->breadcrumbs=array(
	'Presentaciones'=>array('index'),
	$model->descripcion_presentacion,
);

$this->menu=array(
	array('label'=>'Control de Presentaciones','url'=>array('index')),
	array('label'=>'Crear Presentación','url'=>array('create')),
	array('label'=>'Modificar Presentación','url'=>array('update','id'=>$model->presentacion_id)),
	array('label'=>'Borrar Presentación','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->presentacion_id),'confirm'=>'¿Esta seguro que desea borrar este registro?')),
);
?>

<h1>Detalle Presentacion</h1>

<?php 

	$this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
			'descripcion_presentacion',
		),
	)); 

	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$("#info").delay(5000).fadeOut("slow");',
	   CClientScript::POS_READY
	);


?>
