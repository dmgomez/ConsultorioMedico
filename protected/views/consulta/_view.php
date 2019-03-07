<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('consulta_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->consulta_id),array('view','id'=>$data->consulta_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_consulta')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_consulta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('motivo_consulta')); ?>:</b>
	<?php echo CHtml::encode($data->motivo_consulta); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('diagnostico')); ?>:</b>
	<?php //echo CHtml::encode($data->diagnostico); ?>
	<br />
	<?php 
	foreach ($data->patologia as $value) 
	{
		echo $value->descripcion_patologia;
	}
	?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('laboratorio')); ?>:</b>
	<?php echo CHtml::encode($data->laboratorio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('biopsia')); ?>:</b>
	<?php echo CHtml::encode($data->biopsia); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('radio_imagenes')); ?>:</b>
	<?php echo CHtml::encode($data->radio_imagenes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('examen_fisico')); ?>:</b>
	<?php echo CHtml::encode($data->examen_fisico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tratamiento')); ?>:</b>
	<?php echo CHtml::encode($data->tratamiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recomendacion')); ?>:</b>
	<?php echo CHtml::encode($data->recomendacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuario_id_mod')); ?>:</b>
	<?php echo CHtml::encode($data->usuario_id_mod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ult_mod')); ?>:</b>
	<?php echo CHtml::encode($data->ult_mod); ?>
	<br />

	*/ ?>

</div>