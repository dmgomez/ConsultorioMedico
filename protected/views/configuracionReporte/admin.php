<?php
$this->breadcrumbs=array(
	'Configuracion Reportes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ConfiguracionReporte','url'=>array('index')),
	array('label'=>'Create ConfiguracionReporte','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('configuracion-reporte-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Configuracion Reportes</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'configuracion-reporte-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'configuracion_reporte_id',
		'ubicacion_logo',
		'titulo_reporte',
		'subtitulo_1',
		'subtitulo_2',
		'subtitulo_3',
		/*
		'subtitulo_4',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
