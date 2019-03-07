<?php
$this->breadcrumbs=array(
	'Configuracion Reportes'=>array('index'),
	$model->configuracion_reporte_id=>array('view','id'=>$model->configuracion_reporte_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ConfiguracionReporte','url'=>array('index')),
	array('label'=>'Create ConfiguracionReporte','url'=>array('create')),
	array('label'=>'View ConfiguracionReporte','url'=>array('view','id'=>$model->configuracion_reporte_id)),
	array('label'=>'Manage ConfiguracionReporte','url'=>array('admin')),
);
?>

<h1>Update ConfiguracionReporte <?php echo $model->configuracion_reporte_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>