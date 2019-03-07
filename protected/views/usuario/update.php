<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->login_usuario=>array('view','id'=>$model->usuario_id),
	'Modificar',
);

$this->menu=array(
	array('label'=>'Administración de Usuarios','url'=>array('admin')),
	array('label'=>'Crear Usuario','url'=>array('create')),	
);
?>

<h1>Modificar Usuario <?php echo $model->login_usuario; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>