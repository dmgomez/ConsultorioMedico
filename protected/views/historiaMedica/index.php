<?php
$this->breadcrumbs=array(
	'Historia Medicas',
);

$this->menu=array(
	array('label'=>'Create HistoriaMedica','url'=>array('create')),
	array('label'=>'Manage HistoriaMedica','url'=>array('admin')),
);
?>

<h1>Historia Medicas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
