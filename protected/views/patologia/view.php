<?php
$this->breadcrumbs=array(
	'Patologías'=>array('index'),
	$model->descripcion_patologia,
);

$this->menu=array(
	array('label'=>'Control de Patologías','url'=>array('index')),
	array('label'=>'Crear Patología','url'=>array('create')),
	array('label'=>'Modificar Patología','url'=>array('update','id'=>$model->patologia_id)),
	array('label'=>'Borrar Patología','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->patologia_id),'confirm'=>'¿Esta seguro que desea borrar este registro?')),
);
?>

<h1>Detalle de Patologia</h1>

<?php 

$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'descripcion_patologia',
	),
)); 

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$("#info").delay(4000).fadeOut("slow");',
   CClientScript::POS_READY
);

?>
