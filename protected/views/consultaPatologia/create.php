<?php
$this->breadcrumbs=array(
	'Consulta Patologias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ConsultaPatologia','url'=>array('index')),
	array('label'=>'Manage ConsultaPatologia','url'=>array('admin')),
);
?>

<h1>Create ConsultaPatologia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>