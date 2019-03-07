<?php
$this->breadcrumbs=array(
	'Citas'=>array('index'),
	'Ver',
);

$this->menu=array(
	array('label'=>'Control de Citas','url'=>array('index')),
	array('label'=>'Crear Cita','url'=>array('create')),
	array('label'=>'Modificar Cita','url'=>array('update','id'=>$model->cita_id)),
	array('label'=>'Borrar Cita','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->cita_id),'confirm'=>'¿Esta seguro que quiere eliminar esta cita?')),
);
?>

<h1>Detalle de Cita</h1>

<?php 

	$this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
			array('name' => 'Fecha Cita', 'value' => Funciones::invertirFecha($model->fecha_cita)),
			array('name' => 'Cedula Paciente', 'value' => $model->cedulaPaciente),
			array('name' => 'Paciente', 'value' => $model->nombrePaciente),
			array('name' => 'Doctor', 'value' => $model->nombreDoctor),
			'observacion_cita',
		),
	)); 

	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$("#info").delay(5000).fadeOut("slow");',
	   CClientScript::POS_READY
	);

?>