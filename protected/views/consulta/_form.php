
<script type="text/javascript">

	$('.borra_patologia').live("click", function() {

		if (confirm('¿Está seguro de eliminar la patología?'))
		{
			 $.ajax({   

		        url: '<?php echo Yii::app()->createUrl("consulta/eliminarPatologia"); ?>',
		        type: "POST",
		        data: {patologia_id: $(this).attr('id'), idDiagnostico: $("#Consulta_diagnosticoId").val() },
		        dataType: 'json',
		        success: function(datos){  

		          	document.getElementById(datos.id).style.display="none"; 
					$("#Consulta_diagnosticoId").val(datos.idDiag);

		       }

		    }); 
		}

	});

</script>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'consulta-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'paciente_id'); ?>

	<?php echo $form->textFieldRow($model,'nombrePaciente',array('class'=>'span5','maxlength'=>50, 'readonly'=>'readonly')); ?>

	<div class="control-group">
		<div class="controls">
			<?php
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

	<?php echo $form->textAreaRow($model,'antecedentePaciente',array('class'=>'span12','maxlength'=>250, 'rows'=>2)); ?>

	<?php echo $form->textFieldRow($model,'fecha_consulta',array('class'=>'span2','value'=>$fechaHoy,'readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'motivo_consulta',array('class'=>'span12','maxlength'=>150)); ?>

	<?php echo $form->hiddenField($model,'diagnosticoId'); ?>

	<?php //echo $form->textAreaRow($model,'diagnosticoId',array('class'=>'span12', 'rows' => 1)); ?>

	<div style="position: relative; top: 20px; left: 80px;">Diagnóstico</div>
	<div class="control-group" >
		<div class="controls" >
			<div id="nuevasPatologias" style="width: 380px; min-height: 15px; padding: 0.5em; background: #fff; border:1px solid #aaa; border-radius: 0.3em;"> <?php echo $model->_diagnostico;?> </div><br>
		</div>
	</div>

	
	<div class="control-group">

		<div class="controls">
			<?php
				$this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'button',
					'type'=>'inverse',
					'size'=>'medium',
					'label'=>'Examinar',
					'htmlOptions'=>array('title'=>'Busca una patologia en una tabla.', 'data-toggle' => 'modal', 'data-target' => '#buscar-patologia'),
				));

				echo "&nbsp;";

				$this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'button',
					'type'=>'inverse',
					'size'=>'medium',
					'label'=>'Nuevo',
					'htmlOptions'=>array('title'=>'Agrega una patologia.', 'data-toggle' => 'modal', 'data-target' => '#agregar-patologia'),
				));
			?>
		</div>
	</div>

	<?php echo $form->textAreaRow($model,'laboratorio',array('class'=>'span12','maxlength'=>250, 'rows'=>2)); ?>

	<?php echo $form->textAreaRow($model,'biopsia',array('class'=>'span12','maxlength'=>250, 'rows'=>2)); ?>

	<?php echo $form->textAreaRow($model,'radio_imagenes',array('class'=>'span12','maxlength'=>250, 'rows'=>2)); ?>

	<?php echo $form->textAreaRow($model,'examen_fisico',array('class'=>'span12','maxlength'=>250, 'rows'=>2)); ?>

	<?php echo $form->textAreaRow($model,'observaciones',array('class'=>'span12','maxlength'=>250, 'rows'=>2)); ?>

	<?php echo $form->textAreaRow($model,'tratamiento',array('class'=>'span12','maxlength'=>250, 'rows'=>2)); ?>

	<?php echo $form->textAreaRow($model,'recomendacion',array('class'=>'span12','maxlength'=>250, 'rows'=>2)); ?>

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

	<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'buscar-patologia', 'htmlOptions' => array('style' => 'width: 800px; margin-left: -400px'))); ?>

		<?php $this->renderPartial('grid_buscar_patologia', array('model' => new Patologia())); ?>

	<?php $this->endWidget(); ?>

	<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'agregar-patologia', 'htmlOptions' => array('style' => 'width: 800px; margin-left: -400px'))); ?>

		<?php $this->renderPartial('grid_agregar_patologia', array('model' => new Patologia())); ?>

	<?php $this->endWidget(); ?>

	<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'eliminar-patologia', 'htmlOptions' => array('style' => 'width: 800px; margin-left: -400px'))); ?>

		<?php $this->renderPartial('grid_eliminar_patologia', array('model' => new Patologia())); ?>

	<?php $this->endWidget(); ?>


<?php $this->endWidget(); ?>
