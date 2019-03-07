<?php
$this->breadcrumbs=array(
	'Patologías'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Control de Patologías','url'=>array('index')),
);
?>

<h1>Crear Patologia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>