<?php
$this->breadcrumbs=array(
	'Nacionalidads',
);

$this->menu=array(
	array('label'=>'Create Nacionalidad','url'=>array('create')),
	array('label'=>'Manage Nacionalidad','url'=>array('admin')),
);
?>

<h1>Nacionalidads</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
