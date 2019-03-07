<?php
$this->breadcrumbs=array(
	'Pacientes'=>array('index'),
	$model->cedula_paciente=>array('view','id'=>$model->paciente_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Control de Pacientes','url'=>array('index')),
	array('label'=>'Crear Paciente','url'=>array('create')),
);
?>

<h1>Modificar Paciente <?php echo $model->nombre_paciente.' '.$model->apellido_paciente; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>