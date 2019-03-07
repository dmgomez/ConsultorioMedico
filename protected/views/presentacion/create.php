<?php
$this->breadcrumbs=array(
	'Presentaciones'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Control de Presentaciones','url'=>array('index')),
);
?>

<h1>Crear Presentación</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>