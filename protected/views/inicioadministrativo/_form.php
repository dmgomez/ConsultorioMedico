<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cita-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<div class="clear">&nbsp;</div>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'fecha_cita', array('class' => 'control-label')); ?>
		<div class="controls">
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
				 array(
					 'id' => CHtml::getIdByName(get_class($model).'[fecha_cita]'),
					 'name'=>'cita_fecha_cita',
					 'language'=>'es',
					 'model' => $model,
					 'value' => $model->fecha_cita,
					 'attribute'=>'fecha_cita',
					 'htmlOptions' => array('class'=>'span2', 'readonly'=>'readonly'),
					 'options' => array(
						 'showAnim'=>'slideDown',
						 'showButtonPanel' => 'true',
						 'changeMonth'=>true,
						 'changeYear'=>true,
						 'yearRange'=>'1920:'.date('Y'),
						 'autoSize'=>true,
						 'dateFormat'=>'dd-mm-yy',
						 'constrainInput' => 'true'
					 )
				 )
			 ); ?>
			 <?php echo $form->error($model, 'fecha_cita'); ?>
		</div>
	</div>

	<?php echo $form->hiddenField($model,'paciente_id'); ?>

	<?php echo $form->textFieldRow($model,'cedulaPaciente',array('class'=>'span2','maxlength'=>15)); ?>

	<div class="control-group">
		<div class="controls">

			<?php	
				$this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'ajaxSubmit',
					'type'=>'inverse',
					'url'=>$this->createUrl('cita/buscarpacienteporcedula'),
					'size'=>'medium',
					'label'=>'Buscar',
					'htmlOptions'=>array('title'=>'Busca un paciente por su número de cedula.'),
					'ajaxOptions'=>array(
						'type'=>'POST',
						'data'=>'js:{
							cedula: $("#Cita_cedulaPaciente").val()
						}',
						'dataType'=>'json',
						'success' => "js: function(data) {

							if(data.success){
								$('#Cita_nombrePaciente').val(data.paciente);
								$('#Cita_paciente_id').val(data.id);
							}
							else{
								$('#Cita_nombrePaciente').val('');
								$('#Cita_paciente_id').val('');
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

	<?php echo $form->dropDownListRow($model,'doctor_id', CHtml::listData(Usuario::model()->findAll(array('order' => 'nombre_usuario, apellido_usuario', 'condition' => 'tipo_usuario_id = 2 or tipo_usuario_id = 3')), 'usuario_id','nombreCompleto'), array('prompt'=>'Seleccione', 'class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'observacion_cita',array('class'=>'span12','maxlength'=>150)); ?>

	<div class="clear">&nbsp;</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

	<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'buscar-paciente', 'htmlOptions' => array('style' => 'width: 800px; margin-left: -400px'))); ?>

		<?php $this->renderPartial('grid_buscar_paciente', array('model' => new Paciente())); ?>

	<?php $this->endWidget(); ?>

<?php $this->endWidget(); ?>