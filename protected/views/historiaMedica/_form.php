<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'historia-medica-form',
	'enableAjaxValidation'=>false,
	//'type'=>'horizontal',
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php //echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'historia_medica_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'paciente_id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->hiddenField($model,'paciente_id'); ?>

	<?php echo $form->textFieldRow($model,'cedulaPaciente',array('class'=>'span2','maxlength'=>15)); ?>

	<div class="control-group">
		<div class="controls">

			<?php	
				$this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'ajaxSubmit',
					'type'=>'inverse',
					'url'=>$this->createUrl('historiaMedica/buscarpacienteporcedula'),
					'size'=>'medium',
					'label'=>'Buscar',
					'htmlOptions'=>array('title'=>'Busca un paciente por su número de cedula.'),
					'ajaxOptions'=>array(
						'type'=>'POST',
						'data'=>'js:{
							cedula: $("#HistoriaMedica_cedulaPaciente").val()
						}',
						'dataType'=>'json',
						'success' => "js: function(data) {

							if(data.success){
								$('#HistoriaMedica_nombrePaciente').val(data.paciente);
								$('#HistoriaMedica_edadPaciente').val(data.edad);
								$('#HistoriaMedica_paciente_id').val(data.id);
								$('#HistoriaMedica_fechaNacimiento').val(data.fechaNacimiento);
								$('#HistoriaMedica_lugarNacimiento').val(data.lugarNacimiento);
								$('#HistoriaMedica_estadoCivil').val(data.estadoCivil);
								$('#HistoriaMedica_direccion').val(data.direccion);
								$('#HistoriaMedica_telefonoHabitacion').val(data.tlfHab);
								$('#HistoriaMedica_telefonoCelular').val(data.tlfCel);
								$('#HistoriaMedica_seguro').val(data.seguro);
								$('#HistoriaMedica_profesion').val(data.profesion);
								$('#HistoriaMedica_nombrePaciente').focus();
							}
							else{
								$('#HistoriaMedica_nombrePaciente').val('');
								$('#HistoriaMedica_edadPaciente').val('');
								$('#HistoriaMedica_paciente_id').val('');
								$('#HistoriaMedica_fechaNacimiento').val('');
								$('#HistoriaMedica_lugarNacimiento').val('');
								$('#HistoriaMedica_estadoCivil').val('');
								$('#HistoriaMedica_direccion').val('');
								$('#HistoriaMedica_telefonoHabitacion').val('');
								$('#HistoriaMedica_telefonoCelular').val('');
								$('#HistoriaMedica_seguro').val('');
								$('#HistoriaMedica_profesion').val('');
								$('#HistoriaMedica_cedulaPaciente').focus();
							}

							showAlertAnimatedToggled(data.success, 'Paciente encontrado.', data.paciente, 'Error', 'No se encuentra ningun paciente con esa cédula.');
						}",
					),
				));	

				echo "&nbsp;";

				$this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'button',
					'type'=>'inverse',
					'size'=>'medium',
					'label'=>'Examinar',
					'htmlOptions'=>array('title'=>'Busca un paciente en una tabla.', 'data-toggle' => 'modal', 'data-target' => '#buscar-paciente'),
				));

			?>	
		</div>
	</div>

	<?php echo $form->textFieldRow($model,'nombrePaciente',array('class'=>'span5','maxlength'=>50, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'edadPaciente',array('class'=>'span1','maxlength'=>3, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'fechaNacimiento',array('class'=>'span2','maxlength'=>3, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'lugarNacimiento',array('class'=>'span5','maxlength'=>3, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'estadoCivil',array('class'=>'span2','maxlength'=>3, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'direccion',array('class'=>'span5','maxlength'=>3, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'telefonoHabitacion',array('class'=>'span5','maxlength'=>3, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'telefonoCelular',array('class'=>'span5','maxlength'=>3, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'seguro',array('class'=>'span5','maxlength'=>3, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'profesion',array('class'=>'span5','maxlength'=>3, 'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'consulta_id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'referido',array('class'=>'span5','maxlength'=>1000)); ?>

	<div class="clear">&nbsp;</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

	<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'buscar-paciente', 'htmlOptions' => array('style' => 'width: 800px; margin-left: -400px'))); ?>

		<?php $this->renderPartial('grid_buscar_paciente', array('model' => new Paciente())); ?>

	<?php $this->endWidget(); ?>

<?php $this->endWidget(); ?>
