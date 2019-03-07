<?php
$this->breadcrumbs=array(
	'Fármacos'=>array('index'),
	$model->descripcion_farmaco,
);

$this->menu=array(
	array('label'=>'Control de Fármacos','url'=>array('index')),
	array('label'=>'Crear Fármaco','url'=>array('create')),
	array('label'=>'Modificar Fármaco','url'=>array('update','id'=>$model->farmaco_id)),
	array('label'=>'Borrar Fármaco','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->farmaco_id),'confirm'=>'¿Esta seguro que desea borrar este registro?')),
);
?>

<h1>Detalle de Farmaco</h1>

<?php 

$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'descripcion_farmaco',
	),
)); 

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$("#info").delay(4000).fadeOut("slow");',
   CClientScript::POS_READY
);

?>
