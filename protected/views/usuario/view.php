<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	$model->login_usuario,
);

$this->menu=array(
	array('label'=>'Administración de Usuarios','url'=>array('index')),
	array('label'=>'Crear Usuario','url'=>array('create')),
	array('label'=>'Modificar Usuario','url'=>array('update','id'=>$model->usuario_id)),
	array('label'=>'Eliminar Usuario','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->usuario_id),'confirm'=>'¿Esta seguro que quiere eliminar este usuario?')),
);

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$("#info").delay(4000).fadeOut("slow");',
   CClientScript::POS_READY
);

?>

<h1>Detalle Usuario <?php echo $model->login_usuario; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(		
		'login_usuario',
		'cedula_usuario',
		'nombre_usuario',
		'apellido_usuario',
		'descripcionUsuario',
		array('name'=>'activo', 'value'=>$model->get_strActivo()),
		array('name'=>'ultimo_acceso', 'value'=>$model->get_strUltimoAcceso()),
	),
)); 

?>