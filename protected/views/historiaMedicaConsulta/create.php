<?php
$this->breadcrumbs=array(
	'Historia Medica Consultas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HistoriaMedicaConsulta','url'=>array('index')),
	array('label'=>'Manage HistoriaMedicaConsulta','url'=>array('admin')),
);
?>

<h1>Create HistoriaMedicaConsulta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>