<?php
$this->breadcrumbs=array(
	'Historia Medica Consultas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List HistoriaMedicaConsulta','url'=>array('index')),
	array('label'=>'Create HistoriaMedicaConsulta','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('historia-medica-consulta-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Historia Medica Consultas</h1>

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
	'id'=>'historia-medica-consulta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'consulta_id',
		'historia_medica_id',
		'parent_id',
		'title',
		'position',
		/*
		'tooltip',
		'url',
		'icon',
		'visible',
		'task',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
