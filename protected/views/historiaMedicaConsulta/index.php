<?php
$this->breadcrumbs=array(
	'Historia Medica Consultas',
);

$this->menu=array(
	array('label'=>'Create HistoriaMedicaConsulta','url'=>array('create')),
	array('label'=>'Manage HistoriaMedicaConsulta','url'=>array('admin')),
);
?>

<h1>Historia Medica Consultas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
