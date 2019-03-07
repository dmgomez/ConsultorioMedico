<?php
$this->breadcrumbs=array(
	'Patologías'
);

$this->menu=array(	
	array('label'=>'Crear Patología','url'=>array('create')),
);

?>

<h1>Control de Patologías</h1>

<p>
	Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
</p>

<?php 

	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'patologia-grid',
		'dataProvider'=>$model->search(),
		'type'=>'striped',
		'template'=>'{summary}{items}{pager}{summary}',	
		'filter'=>$model,
		'ajaxUpdate' => false,		
		'columns'=>array(
			'descripcion_patologia',
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
				'url'=>$this->createUrl('patologia/index'),
				'htmlOptions'=>array('title'=>'Reestablece los filtros de busqueda a su estado original.'),
	));

	Yii::app()->clientScript->registerScript(
		'myHideEffect',
		'$("#info").delay(4000).fadeOut("slow");',
		CClientScript::POS_READY
	);

?>

<style type="text/css">

input[name="Patologia[descripcion_patologia]"]
{
    max-width: 50%;
}

</style>