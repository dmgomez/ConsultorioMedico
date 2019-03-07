<?php
$this->breadcrumbs=array(
	'Seguros'=>array('index'),
	$model->nombre_seguro,
);

$this->menu=array(
	array('label'=>'Control de Seguros','url'=>array('index')),
	array('label'=>'Crear Seguro','url'=>array('create')),
	array('label'=>'Modificar Seguro','url'=>array('update','id'=>$model->seguro_id)),
	array('label'=>'Borrar Seguro','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->seguro_id),'confirm'=>'¿Esta seguro que desea borrar el registro?')),
);
?>

<h1>Detalle Seguro</h1>

<?php 

$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'nombre_seguro',
	),
)); 


Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$("#info").delay(4000).fadeOut("slow");',
   CClientScript::POS_READY
);

?>
