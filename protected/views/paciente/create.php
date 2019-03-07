<?php
$this->breadcrumbs=array(
	'Pacientes'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Control de Pacientes','url'=>array('admin')),
);
?>

<h1>Crear Paciente</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>