<?php
$this->breadcrumbs=array(
	'Presentaciones'=>array('index'),
);

$this->menu=array(
	array('label'=>'Crear Presentación','url'=>array('create')),
);

?>

<h1>Control de Presentaciones</h1>

<p>
	Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
</p>

<?php 

	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'presentacion-grid',
		'dataProvider'=>$model->search(),
		'type'=>'striped',
		'template'=>'{summary}{items}{pager}{summary}',	
		'ajaxUpdate' => false,
		'filter'=>$model,
		'columns'=>array(
			'descripcion_presentacion',
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
				'url'=>$this->createUrl('presentacion/index'),
				'htmlOptions'=>array('title'=>'Reestablece los filtros de busqueda a su estado original.'),
	));

	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$("#info").delay(5000).fadeOut("slow");',
	   CClientScript::POS_READY
	);

?>
<style type="text/css">

input[name="Presentacion[descripcion_presentacion]"]
{
    max-width: 50%;
}

</style>