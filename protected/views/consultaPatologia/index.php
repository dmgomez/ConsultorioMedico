<?php
$this->breadcrumbs=array(
	'Consulta Patologias',
);

$this->menu=array(
	array('label'=>'Create ConsultaPatologia','url'=>array('create')),
	array('label'=>'Manage ConsultaPatologia','url'=>array('admin')),
);
?>

<h1>Consulta Patologias</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
