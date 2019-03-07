<?php
$this->breadcrumbs=array(
	'Configuracion Reportes'=>array('index'),
	'Configuración de Reportes',
);

$this->menu=array(
	array('label'=>'Modificar Configuración de Reportes','url'=>array('create')),
);
?>

<h1>Configuración de Reportes </h1>

<?php
$cabecera = Funciones::generarCabecera($model->ubicacion_logo, $model->titulo_reporte, $model->subtitulo_1, $model->subtitulo_2, $model->subtitulo_3, $model->subtitulo_4);
echo $cabecera;
?>

