<?php
$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Control de Consultas','url'=>array('index')),
	//array('label'=>'Manage Consulta','url'=>array('admin')),
);
?>

<h1>Crear Consulta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'fechaHoy'=>$fechaHoy)); ?>