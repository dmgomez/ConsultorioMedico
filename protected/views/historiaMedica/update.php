<?php
$this->breadcrumbs=array(
	'Historia Medicas'=>array('index'),
	$model->historia_medica_id=>array('view','id'=>$model->historia_medica_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HistoriaMedica','url'=>array('index')),
	array('label'=>'Create HistoriaMedica','url'=>array('create')),
	array('label'=>'View HistoriaMedica','url'=>array('view','id'=>$model->historia_medica_id)),
	array('label'=>'Manage HistoriaMedica','url'=>array('admin')),
);
?>

<!--<h1>Update HistoriaMedica <?php //echo $model->historia_medica_id; ?></h1>-->

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>