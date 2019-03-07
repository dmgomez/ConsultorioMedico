<?php
$this->breadcrumbs=array(
	'Consultas'=>array('index'),
	'Control de Consultas',
);

$this->menu=array(
	//array('label'=>'List Consulta','url'=>array('index')),
	array('label'=>'Crear Consulta','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('consulta-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Control de Consultas</h1>

<p>
Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
</p>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'consulta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>'striped',
	'template'=>'{summary}{items}{pager}{summary}',
	'columns'=>array(
		/*'consulta_id',
		'paciente_id',*/
		'nombrePaciente',
		'fecha_consulta',
		'motivo_consulta',
//		'diagnostico',
	//	'laboratorio',
		/*
		'biopsia',
		'radio_imagenes',
		'examen_fisico',
		'observaciones',
		'tratamiento',
		'recomendacion',
		'usuario_id',
		'usuario_id_mod',
		'ult_mod',
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
	'url'=>$this->createUrl('consulta/index'),
	'htmlOptions'=>array('title'=>'Reestablece los filtros de busqueda a su estado original.'),
));

Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$("#info").delay(5000).fadeOut("slow");',
	   CClientScript::POS_READY
	);

?>
