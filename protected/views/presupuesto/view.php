<?php
$this->breadcrumbs=array(
	'Presupuestos'=>array('index'),
	'Detalle de Presupuesto',
);

$this->menu=array(
	array('label'=>'Control de Presupuestos','url'=>array('index')),
	array('label'=>'Crear Presupuesto','url'=>array('create')),
	array('label'=>'Modificar Presupuesto','url'=>array('update','id'=>$model->presupuesto_id)),
	array('label'=>'Eliminar Presupuesto','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->presupuesto_id),'confirm'=>'¿Esta seguro que quiere eliminar esta cita?')),
	array('label'=>'Imprimir Presupuesto','url'=>array('generarpdf','id'=>$model->presupuesto_id), 'linkOptions'=>array('target'=>'_BLANK')),
);
?>

<h1>Detalle de Presupuesto</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'presupuesto_id',
		//'paciente_id',
		'cedulaPaciente',
		'nombrePaciente',
		array('name' => 'Edad del Paciente', 'value' => $model->edadPaciente),
		'fecha_presupuesto',
		'condicion',
		'diagnostico',
		'intervencion_tramiento',
		'dias_hospitalizacion',
		array('name' => 'Rutina de Laboratirio', 'value' => $model->rutinaLaboratorio),
		array('name' => 'Tele Torax', 'value' => $model->teleTorax),
		array('name' => 'Biopsia', 'value' => $model->biopsiaP),
		array('name' => 'Cardiovascular', 'value' => $model->cardiovascularP),
		'otros_examenes',
		'medico_tratante',
		'cirujano_principal',
		'ayudante1',
		'ayudante2',
		'anestesiologo',
		'tecnico',
		'urovideo',
		'instrumental',
		'interconsulta',
		'total_presupuesto',
		'observaciones',
	),
)); ?>
