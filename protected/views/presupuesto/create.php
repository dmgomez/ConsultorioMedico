<?php
$this->breadcrumbs=array(
	'Presupuestos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Control de Presupuestos','url'=>array('index')),
);
?>

<h1>Crear Presupuesto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'fechaHoy'=>$fechaHoy)); ?>