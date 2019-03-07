<?php
	$this->breadcrumbs=array(
		'Usuarios'
	);

	$this->menu=array(	
		array('label'=>'Crear Usuario','url'=>array('create')),
	);

?>

<h1>Administración de Usuarios</h1>

<p>
	Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
</p>

<?php 

	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'usuario-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'type' => 'striped',	
		'template'=>'{summary}{items}{pager}{summary}',
		'ajaxUpdate' => false,
		'columns'=>array(
			'login_usuario',
			'cedula_usuario',
			'nombre_usuario',
			'apellido_usuario',
			'descripcionUsuario',
			array('name'=>'activo', 'value'=>'$data->get_strActivo()'),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
			),
		),
	)); 

	$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'link',
				'type'=>'inverse',
				'size'=>'medium',
				'label'=>'Restablecer Filtros',				
				'url'=>$this->createUrl('usuario/index'),
				'htmlOptions'=>array('title'=>'Reestablece los filtros de busqueda a su estado original.'),
	));

	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$("#info").delay(5000).fadeOut("slow");',
	   CClientScript::POS_READY
	);

?>