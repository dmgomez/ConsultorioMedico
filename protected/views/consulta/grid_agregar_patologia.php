<div>

    <div class="modal-header">
        <h2>Agregar Patologia</h2>
    </div> 

	<div class="modal-body">

		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'patologia-form',
			'enableAjaxValidation'=>false,
			'type'=>'horizontal',
		)); ?>

		<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>
		<div class="clear">&nbsp;</div>
		<?php echo $form->textFieldRow($model,'descripcion_patologia',array('class'=>'span5','maxlength'=>100)); ?>

		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'ajaxSubmit',
			'type'=>'primary',
			'url'=>$this->createUrl('consulta/agregarPatologia'),
			'size'=>'medium',
			'label'=>'Crear',
			'htmlOptions'=>array('title'=>'Agrega una Patología a la lista existente.'),
			'ajaxOptions'=>array(
				'type'=>'POST',
				'data'=>'js:{
					patologia: $("#Patologia_descripcion_patologia").val(), patologiasAgregadas: $("#Consulta_diagnosticoId").val()
				}',
				'dataType'=>'json',
				'success' => "js: function(data) {

					if(data.success){
						if (  $('#nuevasPatologias').html() == '' ) 
						{
							$('#nuevasPatologias').html(data.patologiaBorrar);
						}
						else
						{
							$('#nuevasPatologias').html($('#nuevasPatologias').html()+''+data.patologiaBorrar);
						}
						if (  $('#Consulta_diagnosticoId').val() == '' ) 
						{
							$('#Consulta_diagnosticoId').val(data.id);	
						}
						else
						{
							$('#Consulta_diagnosticoId').val($('#Consulta_diagnosticoId').val()+','+data.id);	
						}

						$('#Patologia_descripcion_patologia').val('');
						$('#agregar-patologia').modal('hide');
					}
					else{
						$('#agregar-patologia').modal('hide');
					}

					showAlertAnimatedToggled(data.success, 'Registro agregado con éxito.', 'Se ha seleccionado '+data.patologia, 'Error', data.mensaje);
				}",
			),

		)); ?>


			
		 
		<?php $this->endWidget(); ?>


	</div>

    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cerrar</a>	
    </div>

</div>