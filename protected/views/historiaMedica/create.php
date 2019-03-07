<?php
$this->breadcrumbs=array(
	'Historia Medicas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HistoriaMedica','url'=>array('index')),
	array('label'=>'Manage HistoriaMedica','url'=>array('admin')),
);
?>

<!--<h1>Create HistoriaMedica</h1>-->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>