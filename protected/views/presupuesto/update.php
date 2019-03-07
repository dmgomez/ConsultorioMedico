<?php
$this->breadcrumbs=array(
	'Presupuestos'=>array('index'),
	//$model->presupuesto_id=>array('view','id'=>$model->presupuesto_id),
	$model->nombrePaciente=>array('view','id'=>$model->presupuesto_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Control de Presupuestos','url'=>array('index')),
	array('label'=>'Crear Presupuesto','url'=>array('create')),
	array('label'=>'Ver Presupuesto','url'=>array('view','id'=>$model->presupuesto_id)),
);
?>

<h1>Modificar Presupuesto <?php //echo $model->presupuesto_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'fechaHoy'=>$fechaHoy)); ?>