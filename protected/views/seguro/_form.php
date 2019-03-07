<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'seguro-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<div class="clear">&nbsp;</div>

	<?php echo $form->textFieldRow($model,'nombre_seguro',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="clear">&nbsp;</div>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>