<?php
$this->breadcrumbs=array(
	'Citas'=>array('index'),	
	'Modificar',
);

$this->menu=array(
	array('label'=>'Control de Citas','url'=>array('index')),
	array('label'=>'Crear Cita','url'=>array('create')),
	array('label'=>'Ver Cita','url'=>array('view','id'=>$model->cita_id)),
);
?>

<h1>Modificar Cita</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>