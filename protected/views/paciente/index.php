<?php
$this->breadcrumbs=array(
	'Pacientes',
);

$this->menu=array(
	array('label'=>'Create Paciente','url'=>array('create')),
	array('label'=>'Manage Paciente','url'=>array('admin')),
);
?>

<h1>Pacientes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
