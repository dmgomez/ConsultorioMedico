<?php
$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	//$model->consulta_id=>array('view','id'=>$model->consulta_id),
	$model->nombrePaciente=>array('view','id'=>$model->consulta_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Control de Consultas','url'=>array('index')),
	array('label'=>'Crear Consulta','url'=>array('create')),
	array('label'=>'Ver Consulta','url'=>array('view','id'=>$model->consulta_id)),
	//array('label'=>'Manage Consulta','url'=>array('admin')),
);
?>

<h1>Modificar Consulta</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'fechaHoy'=>$fechaHoy)); ?>nombrePaciente