<?php
$this->breadcrumbs=array(
	'Pacientes'
);

$this->menu=array(	
	array('label'=>'Crear Paciente','url'=>array('create')),
);

?>

<h1>Control de Pacientes</h1>

<p>
	Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
</p>

<?php 

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'paciente-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped',
	'template'=>'{summary}{items}{pager}{summary}',	
	'filter'=>$model,
	'ajaxUpdate' => false,
	'columns'=>array(
		'cedula_paciente',
		'nombre_paciente',
		'apellido_paciente',
		'antecedente_paciente',
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
			'url'=>$this->createUrl('paciente/index'),
			'htmlOptions'=>array('title'=>'Reestablece los filtros de busqueda a su estado original.'),
));

//PARA QUE SE OCULTE EN 5 SEG EL MENSAJE DE ELIMINACION.
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$("#info").delay(4000).fadeOut("slow");',
   CClientScript::POS_READY
);

?>
<style type="text/css">
	th[id="paciente-grid_c0"]
	{
	    width: 14%;
	}
</style>