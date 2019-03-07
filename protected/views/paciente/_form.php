<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'paciente-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<style type="text/css">

		#centrado{
			margin: 0px auto;
			text-align:center;
		}

	</style>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<div id="centrado">
		<div class="control-group" style="display:inline-flex; horizontal-align: middle;">
			<div>
				<video autoplay width="320" height="240" class="img-polaroid"></video>
				<label>Imagen de la Cámara</label>
			</div>
			<div>
				<img src="<?php

				if (file_exists('data_img/pacientes/' . $model->cedula_paciente . '-' . $model->paciente_id . '.png')){
					//ALMACENADA
					echo Yii::app()->getBaseUrl(true) . '/data_img/pacientes/' . $model->cedula_paciente . '-' . $model->paciente_id . '.png';
				}
				elseif (file_exists('data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png')) {
					//TEMPORAL
					echo Yii::app()->getBaseUrl(true) . '/data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png';
				}
				else{
					//NO EXISTE
					echo Yii::app()->getBaseUrl(true) . '/data_img/pacientes/no_disponible.jpg';
				}

				?>" width="320" height="240" class="img-polaroid" style="margin-left:40px">
				<label style="margin-left:40px">Imagen Capturada</label>
			</div>
			<canvas style="display:none;" width="320" height="240" class="img-polaroid"></canvas>
		</div>
		<div class="control-group">

			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'ajaxSubmit',
				'type'=>'info',
				'size'=>'medium',
				'label'=>'Tomar Fotografia',
				'url'=>$this->createUrl('paciente/subirFoto'),
				'htmlOptions'=>array('id'=>'btnSnapShoot'),
				'ajaxOptions'=>array(
					'type'=>'POST',
					'dataType'=>'json',
					'success' => "js: function(retorno) {
						showAlertAnimatedToggled(retorno.success, 'Imagen Capturada Satisfactoriamente.', 'Si desea capturar otra fotografia, presione de nuevo el boton \'Tomar Fotografia\'.', 'Error', 'No se pudo guardar la imagen. Contacte a su administrador de sistemas.');
					}",
				),

			));
			?>

		</div>				
	</div>

	<input type="hidden" name="img64" id="img64">

	<div class="clear">&nbsp;</div>

	<?php echo $form->dropDownListRow($model,'nacionalidad_id', CHtml::listData(Nacionalidad::model()->findAll(), 'nacionalidad_id','descripcion_nacionalidad'), array('prompt'=>'Seleccione', 'class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cedula_paciente',array('class'=>'span5','maxlength'=>15, 'placeholder'=>'Ej: 11222333')); ?>

	<?php echo $form->dropDownListRow($model,'sexo', array('M'=>'Masculino', 'F'=>'Femenino'), array('prompt'=>'Seleccione', 'class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'nombre_paciente',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'apellido_paciente',array('class'=>'span5','maxlength'=>50)); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'fecha_nacimiento', array('class' => 'control-label')); ?>
		<div class="controls">
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
				 array(
					 'id' => CHtml::getIdByName(get_class($model).'[fecha_nacimiento]'),
					 'name'=>'paciente_fecha_nacimiento',
					 'language'=>'es',
					 'model' => $model,
					 'value' => $model->fecha_nacimiento,
					 'attribute'=>'fecha_nacimiento',
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
			 <?php echo $form->error($model, 'fecha_nacimiento'); ?>
		</div>
	</div>

	<?php echo $form->textFieldRow($model,'lugar_nacimiento',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->dropDownListRow($model,'estado_civil_id', CHtml::listData(EstadoCivil::model()->findAll(), 'estado_civil_id','descripcion_estado_civil'), array('prompt'=>'Seleccione', 'class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'telefono_celular',array('class'=>'span5','maxlength'=>11, 'placeholder'=>'Ej: 04145556666')); ?>

	<?php echo $form->textFieldRow($model,'telefono_habitacion',array('class'=>'span5','maxlength'=>11, 'placeholder'=>'Ej: 02617554444')); ?>

	<?php echo $form->textAreaRow($model,'direccion_paciente',array('class'=>'span12','maxlength'=>150, 'rows'=>3)); ?>

	<?php echo $form->textFieldRow($model,'correo_electronico',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'profesion_paciente',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->dropDownListRow($model,'seguro_id', CHtml::listData(Seguro::model()->findAll(), 'seguro_id','nombre_seguro'), array('prompt'=>'Seleccione', 'class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'antecedente_paciente',array('class'=>'span12','maxlength'=>200, 'rows'=>5)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
  var video = document.querySelector('video');
  var canvas = document.querySelector('canvas');
  var ctx = canvas.getContext('2d');
  var localMediaStream = null;
  var errorCallback = function(e) {
      console.log('Ocurrio un error: ', e);
  };
  var height = 320;
  var width = 240;
  var dataURL;

  function snapshot() {
    if (localMediaStream) {
      ctx.drawImage(video, 0, 0, 320, 240);
      // "image/webp" works in Chrome.
      // Other browsers will fall back to image/png.
      dataURL = canvas.toDataURL('image/png');
      document.querySelector('img').src = dataURL;
      document.getElementById('img64').value = dataURL;
    }
  }

  video.addEventListener('click', snapshot, false);

  btnSnapShoot.addEventListener('click', snapshot, false);

  video.addEventListener('canplay', function(ev){
    if (!localMediaStream) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      localMediaStream = true;
    }
  }, false);

  navigator.getMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

  navigator.getMedia(
    {video: true}, 

    function(stream) {

      if(navigator.mozGetUserMedia){
        video.mozSrcObject = stream;
      }
      else{
        video.src = window.URL.createObjectURL(stream);      
      }

      localMediaStream = stream;
    }, 

    errorCallback
  );
</script>