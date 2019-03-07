<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nacionalidad_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nacionalidad_id),array('view','id'=>$data->nacionalidad_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_nacionalidad')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_nacionalidad); ?>
	<br />


</div>