<?php
$this->breadcrumbs=array(
	'Citas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Control de Citas','url'=>array('admin')),
);
?>

<h1>Crear Cita</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>