<?php
$this->breadcrumbs=array(
	'Configuracion Reportes',
);

$this->menu=array(
	array('label'=>'Crear Configuración de Reportes','url'=>array('create')),
	//array('label'=>'Manage ConfiguracionReporte','url'=>array('admin')),
);
?>

<h1>Configuración de Reportes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
