<?php
$this->breadcrumbs=array(
	'Citas',
);

$this->menu=array(
	array('label'=>'Crear Cita','url'=>array('create')),
);

?>

<h1>Control de Citas</h1>

<p>
	Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
</p>

<?php

	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'cita-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'type'=>'striped',
		'template'=>'{summary}{items}{pager}{summary}',
		'columns'=>array(
			array('name'=>'fecha_cita', 'value'=>'Funciones::invertirFecha($data->fecha_cita)'),
			'cedulaPaciente',
			'nombrePaciente',
			'nombreDoctor',
			'descripcionEstadoCita',
			'observacion_cita',
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
				'url'=>$this->createUrl('cita/index'),
				'htmlOptions'=>array('title'=>'Reestablece los filtros de busqueda a su estado original.'),
	));

	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$("#info").delay(5000).fadeOut("slow");',
	   CClientScript::POS_READY
	);

?>