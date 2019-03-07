<?php
$this->breadcrumbs=array(
	'Presentaciones'=>array('index'),
	$model->descripcion_presentacion=>array('view','id'=>$model->presentacion_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Control de Presentaciones','url'=>array('index')),
	array('label'=>'Crear Presentación','url'=>array('create')),
);
?>

<h1>Modificar Presentación</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>