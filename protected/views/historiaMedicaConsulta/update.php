<?php
$this->breadcrumbs=array(
	'Historia Medica Consultas'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HistoriaMedicaConsulta','url'=>array('index')),
	array('label'=>'Create HistoriaMedicaConsulta','url'=>array('create')),
	array('label'=>'View HistoriaMedicaConsulta','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage HistoriaMedicaConsulta','url'=>array('admin')),
);
?>

<h1>Update HistoriaMedicaConsulta <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>