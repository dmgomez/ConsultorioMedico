<?php
$this->breadcrumbs=array(
	'Fármacos'=>array('index'),
	$model->descripcion_farmaco=>array('view','id'=>$model->farmaco_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Control de Fármacos','url'=>array('index')),
	array('label'=>'Crear Fármaco','url'=>array('create')),
);
?>

<h1>Modificar Fármaco</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>