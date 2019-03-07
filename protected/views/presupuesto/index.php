<?php
$this->breadcrumbs=array(
	'Presupuestos',
);

$this->menu=array(
	array('label'=>'Crear Presupuesto','url'=>array('create')),
	array('label'=>'Actualizar Presupuesto','url'=>array('admin')),
);
?>

<h1>Presupuestos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
