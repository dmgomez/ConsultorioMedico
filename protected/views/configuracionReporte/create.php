<?php
$this->breadcrumbs=array(
	'Configuracion Reportes'=>array('index'),
	'Configurar Cabecera de Reportes',
);

$this->menu=array(
	array('label'=>'Ver Configuración de Reportes','url'=>array('index')),
	//array('label'=>'Manage ConfiguracionReporte','url'=>array('admin')),
);
?>

<h1>Configurar Cabecera de Reportes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>