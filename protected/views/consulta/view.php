<?php
$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	'Ver Consulta',
);

$this->menu=array(
	array('label'=>'Control de Consultas','url'=>array('index')),
	array('label'=>'Crear Consulta','url'=>array('create')),
	array('label'=>'Modificar Consulta','url'=>array('update','id'=>$model->consulta_id)),
	array('label'=>'Eliminar Consulta','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->consulta_id),'confirm'=>'¿Está seguro que desea eliminar esta consulta?')),
);
?>

<h1>Detalle de Consulta</h1>

<?php 
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'nombrePaciente',
		'antecedentePaciente',
		'fecha_consulta',
		'motivo_consulta',
		array('name' => 'Diagnóstico', 'value' => Funciones::omitirIcono($model->_diagnostico)),
		'laboratorio',
		'biopsia',
		'radio_imagenes',
		'examen_fisico',
		'observaciones',
		'tratamiento',
		'recomendacion',
	),
)); 

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$("#info").delay(5000).fadeOut("slow");',
   CClientScript::POS_READY
);

?>
