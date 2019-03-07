<?php
$this->breadcrumbs=array(
	'Seguros'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Control de Seguros','url'=>array('index')),
);
?>

<h1>Crear Seguro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>