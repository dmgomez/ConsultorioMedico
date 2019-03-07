<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('historia_medica_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->historia_medica_id),array('view','id'=>$data->historia_medica_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paciente_id')); ?>:</b>
	<?php echo CHtml::encode($data->paciente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consulta_id')); ?>:</b>
	<?php echo CHtml::encode($data->consulta_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referido')); ?>:</b>
	<?php echo CHtml::encode($data->referido); ?>
	<br />


</div>