<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('configuracion_reporte_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->configuracion_reporte_id),array('view','id'=>$data->configuracion_reporte_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ubicacion_logo')); ?>:</b>
	<?php echo CHtml::encode($data->ubicacion_logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo_reporte')); ?>:</b>
	<?php echo CHtml::encode($data->titulo_reporte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subtitulo_1')); ?>:</b>
	<?php echo CHtml::encode($data->subtitulo_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subtitulo_2')); ?>:</b>
	<?php echo CHtml::encode($data->subtitulo_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subtitulo_3')); ?>:</b>
	<?php echo CHtml::encode($data->subtitulo_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subtitulo_4')); ?>:</b>
	<?php echo CHtml::encode($data->subtitulo_4); ?>
	<br />


</div>