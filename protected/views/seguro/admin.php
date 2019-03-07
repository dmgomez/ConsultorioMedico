<?php
$this->breadcrumbs=array(
	'Seguros'=>array('index'),
);

$this->menu=array(
	array('label'=>'Crear Seguro','url'=>array('create')),
);

?>

<h1>Control de Seguros</h1>

<?php 

	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'seguro-grid',
		'dataProvider'=>$model->search(),
		'type'=>'striped',
		'ajaxUpdate' => false,
		'template'=>'{summary}{items}{pager}{summary}',	
		'filter'=>$model,
		'columns'=>array(
			'nombre_seguro',
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
				'url'=>$this->createUrl('seguro/index'),
				'htmlOptions'=>array('title'=>'Reestablece los filtros de busqueda a su estado original.'),
	));


	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$("#info").delay(4000).fadeOut("slow");',
	   CClientScript::POS_READY
	);
	
?>

<style type="text/css">

input[name="Seguro[nombre_seguro]"]
{
    max-width: 50%;
}

</style>