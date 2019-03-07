<?php
$this->breadcrumbs=array(
	'Presupuestos'=>array('index'),
	'Control de Presupuestos',
);

$this->menu=array(
	array('label'=>'Crear Presupuesto','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('presupuesto-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Control de Presupuestos</h1>

<p>
Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
</p>

<?php 

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'presupuesto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'presupuesto_id',
	//	'paciente_id',
		'cedulaPaciente',
		'nombrePaciente',
		'fecha_presupuesto',
		'condicion',
		'diagnostico',
		//'intervencion_tramiento',
		/*
		'dias_hospitalizacion',
		'rutina_laboratorio',
		'tele_torax',
		'biopsia',
		'cardiovascular',
		'otros_examenes',
		'medico_tratante',
		'cirujano_principal',
		'ayudante1',
		'ayudante2',
		'anestesiologo',
		'tecnico',
		'urovideo',
		'instrumental',
		'interconsulta',
		'total_presupuesto',
		'observaciones',
		*/
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
	'url'=>$this->createUrl('presupuesto/index'),
	'htmlOptions'=>array('title'=>'Reestablece los filtros de busqueda a su estado original.'),
));

?>
