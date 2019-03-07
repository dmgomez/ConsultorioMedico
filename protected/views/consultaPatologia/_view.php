<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('consulta_patologia_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->consulta_patologia_id),array('view','id'=>$data->consulta_patologia_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consulta_id')); ?>:</b>
	<?php echo CHtml::encode($data->consulta_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patologia_id')); ?>:</b>
	<?php echo CHtml::encode($data->patologia_id); ?>
	<br />


</div>