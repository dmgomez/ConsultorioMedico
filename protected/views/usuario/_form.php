<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'usuario-form',
	'enableClientValidation'=>true,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son obligatorios.</p>

	<div class="clear">&nbsp;</div>

	<?php echo $form->textFieldRow($model,'login_usuario',array('class'=>'span5','maxlength'=>12, 'placeholder'=>'Máximo 12 caracteres alfanumericos.')); ?>

	<?php 

	if (!$model->isNewRecord) {

	?>

	<div class="control-group">
	<div class="controls">
	<label>Cambiar Clave en el Próximo Inicio de Sesión</label>
	<?php
		
		$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'ajaxSubmit',
			'type'=>'inverse',
			'url'=>$this->createUrl('usuario/resetpassword', array('identificador'=>$model->usuario_id)),
			'size'=>'medium',
			'label'=>'Resetear Clave',
			'htmlOptions'=>array('title'=>'Establece la clave en blanco para que el usuario la cambie en el proximo inicio de sesión.'),
			'ajaxOptions'=>array(
				'type'=>'POST',
				'dataType'=>'json',
				'success' => "js: function(data) {					
					showAlertAnimatedToggled(data.success, '', 'Clave reseteada satisfactoriamente. El usuario podrá cambiarla en el próximo inicio de sesión.', '', 'Error. No se pudo resetear la clave. Contacte a su administrador de sistemas.');
				}",
			),
		));

	?>

	<div class="clear">&nbsp;</div>
	</div>	
	</div>

	<?php

	} 

	?>

	<?php if($model->isNewRecord){ echo $form->passwordFieldRow($model,'clave_usuario',array('class'=>'span5','maxlength'=>12, 'placeholder'=>'Máximo 12 caracteres alfanumericos.')); } ?>

	<?php if($model->isNewRecord){ echo $form->passwordFieldRow($model,'clave_usuario_repeat',array('class'=>'span5','maxlength'=>12, 'placeholder'=>'Máximo 12 caracteres alfanumericos.')); } ?>

	<?php echo $form->textFieldRow($model,'cedula_usuario',array('class'=>'span5','maxlength'=>8, 'placeholder'=>'Ej: 11222333')); ?>

	<?php echo $form->textFieldRow($model,'nombre_usuario',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'apellido_usuario',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->dropDownListRow($model,'tipo_usuario_id', CHtml::listData(TipoUsuario::model()->findAll(), 'tipo_usuario_id','descripcion_tipo_usuario'), array('prompt'=>'Seleccione', 'class'=>'span5')); ?>

	<?php echo $form->checkBoxRow($model,'activo'); ?>

	<div class="clear">&nbsp;</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>
	
<?php 

if($model->isNewRecord){

	Yii::app()->clientScript->registerScript('ValidarClave', "

		$('#Usuario_clave_usuario').keyup(function(){
		        var pass_1 = $('#Usuario_clave_usuario').val();
		        var _this_1 = $('#Usuario_clave_usuario');
		        var pass_2 = $('#Usuario_clave_usuario_repeat').val();
		        var _this_2 = $('#Usuario_clave_usuario_repeat');
				
		        _this_1.attr('style', 'background:white');
		        _this_2.attr('style', 'background:white');

		        if(pass_1 != '' && pass_2 != ''){

			        if(pass_1 == pass_2){
						_this_1.attr('style', 'background:#99FF99');
						_this_2.attr('style', 'background:#99FF99');
			        }
			        else{
			        	_this_1.attr('style', 'background:#FF6600');
			        	_this_2.attr('style', 'background:#FF6600');
			        }
		        }
		});
		 
		$('#Usuario_clave_usuario_repeat').keyup(function(){
		        var pass_1 = $('#Usuario_clave_usuario').val();
		        var _this_1 = $('#Usuario_clave_usuario');
		        var pass_2 = $('#Usuario_clave_usuario_repeat').val();
		        var _this_2 = $('#Usuario_clave_usuario_repeat');

		        _this_1.attr('style', 'background:white');
		        _this_2.attr('style', 'background:white');

		        if(pass_1 != '' && pass_2 != ''){

			        if(pass_1 == pass_2){
						_this_1.attr('style', 'background:#99FF99');
						_this_2.attr('style', 'background:#99FF99');
			        }
			        else{
			        	_this_1.attr('style', 'background:#FF6600');
			        	_this_2.attr('style', 'background:#FF6600');
			        }
		        }
		});

	");
}

$this->endWidget(); 
?>