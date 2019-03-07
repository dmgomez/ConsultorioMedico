<?php

$this->breadcrumbs=array(
	'Pacientes'=>array('index'),
	$model->cedula_paciente,
);

$this->menu=array(
	array('label'=>'Control de Pacientes','url'=>array('index')),
	array('label'=>'Crear Paciente','url'=>array('create')),
	array('label'=>'Modificar Paciente','url'=>array('update','id'=>$model->paciente_id)),
	array('label'=>'Borrar Paciente','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->paciente_id),'confirm'=>'¿Esta seguro que desea borrar este registro?')),
);
?>

<style type="text/css">

	#centrado{
		margin: 0px auto;
		text-align:center;
	}

</style>

<h1>Detalle Paciente <?php echo $model->nombre_paciente.' '.$model->apellido_paciente; ?></h1>

<div id="centrado">
	<img src="<?php

	if (file_exists('data_img/pacientes/' . $model->cedula_paciente . '-' . $model->paciente_id . '.png')){
		//ALMACENADA
		echo Yii::app()->getBaseUrl(true) . '/data_img/pacientes/' . $model->cedula_paciente . '-' . $model->paciente_id . '.png';
	}
	else{
		//NO EXISTE
		echo Yii::app()->getBaseUrl(true) . '/data_img/pacientes/no_disponible.jpg';
		//echo Yii::app()->getBaseUrl(true) . '/data_img/pacientes/' . $model->cedula_paciente . '-' . $model->paciente_id . '.png';
	}

	?>" width="200" height="100" class="img-polaroid">
</div>

<div class="clear">&nbsp;</div>

<?php 

$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array('name'=>'nacionalidad_id', 'value'=>$model->nacionalidad->descripcion_nacionalidad),
		'cedula_paciente',		
		'nombre_paciente',
		'sexo',
		'apellido_paciente',
		'direccion_paciente',
		'telefono_habitacion',
		'telefono_celular',
		array('name'=>'fecha_nacimiento', 'value'=>Funciones::invertirFecha($model->fecha_nacimiento)),
		'correo_electronico',
		'lugar_nacimiento',
		'profesion_paciente',
		'antecedente_paciente',
		array('name'=>'seguro_id', 'value'=>$model->seguro->nombre_seguro),
		array('name'=>'estado_civil_id', 'value'=>$model->estadoCivil->descripcion_estado_civil),
	),
)); 

//PARA QUE SE OCULTE EN 5 SEG EL MENSAJE DE MODIFICACION Y CREACION.
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$("#info").delay(4000).fadeOut("slow");',
   CClientScript::POS_READY
);

?>
