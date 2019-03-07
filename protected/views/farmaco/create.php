<?php
$this->breadcrumbs=array(
	'Fármacos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Control de Fármacos','url'=>array('index')),
);
?>

<h1>Crear Fármaco</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>