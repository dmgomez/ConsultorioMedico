<?php
$this->breadcrumbs=array(
	'Consulta Patologias'=>array('index'),
	$model->consulta_patologia_id=>array('view','id'=>$model->consulta_patologia_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ConsultaPatologia','url'=>array('index')),
	array('label'=>'Create ConsultaPatologia','url'=>array('create')),
	array('label'=>'View ConsultaPatologia','url'=>array('view','id'=>$model->consulta_patologia_id)),
	array('label'=>'Manage ConsultaPatologia','url'=>array('admin')),
);
?>

<h1>Update ConsultaPatologia <?php echo $model->consulta_patologia_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>