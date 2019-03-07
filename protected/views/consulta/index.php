<?php
$this->breadcrumbs=array(
	'Consultas',
);

$this->menu=array(
	array('label'=>'Create Consulta','url'=>array('create')),
	array('label'=>'Manage Consulta','url'=>array('admin')),
);
?>

<h1>Consultas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
