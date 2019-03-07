<?php
$this->breadcrumbs=array(
	'Fármacos',
);

$this->menu=array(
	array('label'=>'Crear Fármaco','url'=>array('create')),
);

?>

<h1>Control de Fármacos</h1>

<p>
	Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
</p>

<?php 

	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'farmaco-grid',
		'dataProvider'=>$model->search(),
		'type'=>'striped',
		'ajaxUpdate' => false,
		'template'=>'{summary}{items}{pager}{summary}',	
		'filter'=>$model,
		'columns'=>array(
			'descripcion_farmaco',
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
				'url'=>$this->createUrl('farmaco/index'),
				'htmlOptions'=>array('title'=>'Reestablece los filtros de busqueda a su estado original.'),
	));


	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$("#info").delay(4000).fadeOut("slow");',
	   CClientScript::POS_READY
	);

?>
<style type="text/css">

input[name="Farmaco[descripcion_farmaco]"]
{
    max-width: 50%;
}

</style>