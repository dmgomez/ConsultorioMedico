<?php
$this->breadcrumbs=array(
	'Citas',
);

$this->menu=array(
	array('label'=>'Create Cita','url'=>array('create')),
	array('label'=>'Manage Cita','url'=>array('admin')),
);
?>

<h1>Citas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
