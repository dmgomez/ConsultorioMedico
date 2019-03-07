<?php

$this->breadcrumbs=array(
	'Seguros'=>array('index'),
	$model->nombre_seguro=>array('view','id'=>$model->seguro_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Control de Seguros','url'=>array('index')),
	array('label'=>'Crear Seguro','url'=>array('create')),
);

?>

<h1>Modificar Seguro</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>