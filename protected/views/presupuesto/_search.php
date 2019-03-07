<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'presupuesto_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'paciente_id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'fecha_presupuesto',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'condicion',array('class'=>'span5','maxlength'=>1000)); ?>

	<?php echo $form->textFieldRow($model,'diagnostico',array('class'=>'span5','maxlength'=>1000)); ?>

	<?php echo $form->textFieldRow($model,'intervencion_tramiento',array('class'=>'span5','maxlength'=>1000)); ?>

	<?php echo $form->textFieldRow($model,'dias_hospitalizacion',array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'rutina_laboratorio',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'tele_torax',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'biopsia',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'cardiovascular',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'otros_examenes',array('class'=>'span5','maxlength'=>1000)); ?>

	<?php echo $form->textFieldRow($model,'medico_tratante',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cirujano_principal',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ayudante1',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ayudante2',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'anestesiologo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'tecnico',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'urovideo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'instrumental',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'interconsulta',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'total_presupuesto',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'observaciones',array('class'=>'span5','maxlength'=>1000)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
