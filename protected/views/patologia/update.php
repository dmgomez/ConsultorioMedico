<?php
$this->breadcrumbs=array(
	'Patologías'=>array('index'),
	$model->descripcion_patologia=>array('view','id'=>$model->patologia_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Control de Patologías','url'=>array('index')),
	array('label'=>'Crear Patología','url'=>array('create')),
);
?>

<h1>Modificar Patologia</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>