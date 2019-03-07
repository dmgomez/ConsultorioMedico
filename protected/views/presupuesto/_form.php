<style>

.data {
  margin: 40px auto;
  border: 1px solid #cdd3d7;
  border-radius: 8px;
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.data-header {
  position: relative;
  line-height: 24px;
  padding: 7px 15px;
  color: #5d6b6c;
  text-shadow: 0 1px rgba(255, 255, 255, 0.7);
  background: #f0f1f2;
  border-bottom: 1px solid #d1d1d1;
  border-radius: 3px 3px 0 0;
  -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 1px rgba(0, 0, 0, 0.03);
  box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 1px rgba(0, 0, 0, 0.03);
}

.data-body{
	position: relative;
	padding-top: 1em;
}

.data-title {
  line-height: inherit;
  font-size: 14px;
  font-weight: bold;
}

</style>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'presupuesto-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p>
	<p>&nbsp;</p>

	<?php //echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'fecha_presupuesto',array('class'=>'span2','value'=>$fechaHoy,'readonly'=>'readonly')); ?>

	<section class="data">
	    <header class="data-header">
	    	<h2 class="data-title">Datos del Paciente:</h2>
	    </header>

	    <body class="data-body">

			<?php echo $form->hiddenField($model,'paciente_id'); ?>

			<?php echo $form->textFieldRow($model,'cedulaPaciente',array('class'=>'span2','maxlength'=>15)); ?>

			<div class="control-group">
				<div class="controls">

					<?php
						$this->widget('bootstrap.widgets.TbButton', array(
							'buttonType'=>'ajaxSubmit',
							'type'=>'inverse',
							'url'=>$this->createUrl('presupuesto/BuscarPacientePorCedula'),
							'size'=>'medium',
							'label'=>'Buscar',
							'htmlOptions'=>array('title'=>'Busca un paciente por su número de cedula.'),
							'ajaxOptions'=>array(
								'type'=>'POST',
								'data'=>'js:{
									cedula: $("#Presupuesto_cedulaPaciente").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_nombrePaciente').val(data.paciente);
										$('#Presupuesto_paciente_id').val(data.id);
										$('#Presupuesto_edadPaciente').val(data.edad);
									}
									else{
										$('#Presupuesto_nombrePaciente').val('');
										$('#Presupuesto_paciente_id').val('');
										$('#Presupuesto_edadPaciente').val('');
									}

									showAlertAnimatedToggled(data.success, 'Paciente encontrado.', data.paciente, 'Error', 'No se encuentra ningun paciente con esa cedula.');
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

			<?php echo $form->textFieldRow($model,'condicion',array('class'=>'span5','maxlength'=>150)); ?>

		</body>

	</section>

	<section class="data">
	    <header class="data-header">
	    	<h2 class="data-title">Datos Clinicos:</h2>
	    </header>

	    <body>

			<?php echo $form->textFieldRow($model,'diagnostico',array('class'=>'span5','maxlength'=>150)); ?>

			<?php echo $form->textFieldRow($model,'intervencion_tramiento',array('class'=>'span5','maxlength'=>150)); ?>

			<?php echo $form->textFieldRow($model,'dias_hospitalizacion',array('class'=>'span1','maxlength'=>2)); ?>

		</body>

	</section>

	<section class="data">
	    <header class="data-header">
	    	<h2 class="data-title">Estudios Requeridos:</h2>
	    </header>

	    <body>

			<div class="control-group">
				<?php echo $form->labelEx($model, 'rutina_laboratorio', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->checkBox($model,'rutina_laboratorio'); ?>
				</div>
			</div>

			<div class="control-group">
				<?php echo $form->labelEx($model, 'tele_torax', array('class' => 'control-label')); ?>
				<div class="controls">
					<?php echo $form->checkBox($model,'tele_torax'); ?>
				</div>
			</div>

			<div class="control-group">
				<?php echo $form->labelEx($model, 'biopsia', array('class' => 'control-label')); ?>
				<div class="controls">
					<?php echo $form->checkBox($model,'biopsia'); ?>
				</div>
			</div>

			<div class="control-group">
				<?php echo $form->labelEx($model, 'cardiovascular', array('class' => 'control-label')); ?>
				<div class="controls">
					<?php echo $form->checkBox($model,'cardiovascular'); ?>
				</div>
			</div>

			<?php echo $form->textFieldRow($model,'otros_examenes',array('class'=>'span5','maxlength'=>150)); ?>
		</body>

	</section>

	<section class="data">
	    <header class="data-header">
	    	<h2 class="data-title">Honorarios:</h2>
	    </header>

	    <body>

			<?php echo $form->textFieldRow($model,'medico_tratante',array('class'=>'span2','maxlength'=>10, 'ajax' => array(
		                        'type' =>'POST',
		                        'url' => $this->createUrl('presupuesto/ActualizarTotal'),
		                        'data' => 'js:{
									medico: $("#Presupuesto_medico_tratante").val(), cirujano: $("#Presupuesto_cirujano_principal").val(), a1: $("#Presupuesto_ayudante1").val(), a2: $("#Presupuesto_ayudante2").val(),
									anestesiologo: $("#Presupuesto_anestesiologo").val(), tecnico: $("#Presupuesto_tecnico").val(), urovideo: $("#Presupuesto_urovideo").val(), instrumental: $("#Presupuesto_instrumental").val(),
									interconsulta: $("#Presupuesto_interconsulta").val(), total: $("#Presupuesto_total_presupuesto").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_total_presupuesto').val(data.total);
									}

								}",
		                    ))); ?>

			<?php echo $form->textFieldRow($model,'cirujano_principal',array('class'=>'span2','maxlength'=>10, 'ajax' => array(
		                        'type' =>'POST',
		                        'url' => $this->createUrl('presupuesto/ActualizarTotal'),
		                        'data' => 'js:{
									medico: $("#Presupuesto_medico_tratante").val(), cirujano: $("#Presupuesto_cirujano_principal").val(), a1: $("#Presupuesto_ayudante1").val(), a2: $("#Presupuesto_ayudante2").val(),
									anestesiologo: $("#Presupuesto_anestesiologo").val(), tecnico: $("#Presupuesto_tecnico").val(), urovideo: $("#Presupuesto_urovideo").val(), instrumental: $("#Presupuesto_instrumental").val(),
									interconsulta: $("#Presupuesto_interconsulta").val(), total: $("#Presupuesto_total_presupuesto").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_total_presupuesto').val(data.total);
									}

								}",
		                    ))); ?>

			<?php echo $form->textFieldRow($model,'ayudante1',array('class'=>'span2','maxlength'=>10, 'ajax' => array(
		                        'type' =>'POST',
		                        'url' => $this->createUrl('presupuesto/ActualizarTotal'),
		                        'data' => 'js:{
									medico: $("#Presupuesto_medico_tratante").val(), cirujano: $("#Presupuesto_cirujano_principal").val(), a1: $("#Presupuesto_ayudante1").val(), a2: $("#Presupuesto_ayudante2").val(),
									anestesiologo: $("#Presupuesto_anestesiologo").val(), tecnico: $("#Presupuesto_tecnico").val(), urovideo: $("#Presupuesto_urovideo").val(), instrumental: $("#Presupuesto_instrumental").val(),
									interconsulta: $("#Presupuesto_interconsulta").val(), total: $("#Presupuesto_total_presupuesto").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_total_presupuesto').val(data.total);
									}

								}",
		                    ))); ?>

			<?php echo $form->textFieldRow($model,'ayudante2',array('class'=>'span2','maxlength'=>10, 'ajax' => array(
		                        'type' =>'POST',
		                        'url' => $this->createUrl('presupuesto/ActualizarTotal'),
		                        'data' => 'js:{
									medico: $("#Presupuesto_medico_tratante").val(), cirujano: $("#Presupuesto_cirujano_principal").val(), a1: $("#Presupuesto_ayudante1").val(), a2: $("#Presupuesto_ayudante2").val(),
									anestesiologo: $("#Presupuesto_anestesiologo").val(), tecnico: $("#Presupuesto_tecnico").val(), urovideo: $("#Presupuesto_urovideo").val(), instrumental: $("#Presupuesto_instrumental").val(),
									interconsulta: $("#Presupuesto_interconsulta").val(), total: $("#Presupuesto_total_presupuesto").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_total_presupuesto').val(data.total);
									}

								}",
		                    ))); ?>

			<?php echo $form->textFieldRow($model,'anestesiologo',array('class'=>'span2','maxlength'=>10, 'ajax' => array(
		                        'type' =>'POST',
		                        'url' => $this->createUrl('presupuesto/ActualizarTotal'),
		                        'data' => 'js:{
									medico: $("#Presupuesto_medico_tratante").val(), cirujano: $("#Presupuesto_cirujano_principal").val(), a1: $("#Presupuesto_ayudante1").val(), a2: $("#Presupuesto_ayudante2").val(),
									anestesiologo: $("#Presupuesto_anestesiologo").val(), tecnico: $("#Presupuesto_tecnico").val(), urovideo: $("#Presupuesto_urovideo").val(), instrumental: $("#Presupuesto_instrumental").val(),
									interconsulta: $("#Presupuesto_interconsulta").val(), total: $("#Presupuesto_total_presupuesto").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_total_presupuesto').val(data.total);
									}

								}",
		                    ))); ?>

			<?php echo $form->textFieldRow($model,'tecnico',array('class'=>'span2','maxlength'=>10, 'ajax' => array(
		                        'type' =>'POST',
		                        'url' => $this->createUrl('presupuesto/ActualizarTotal'),
		                        'data' => 'js:{
									medico: $("#Presupuesto_medico_tratante").val(), cirujano: $("#Presupuesto_cirujano_principal").val(), a1: $("#Presupuesto_ayudante1").val(), a2: $("#Presupuesto_ayudante2").val(),
									anestesiologo: $("#Presupuesto_anestesiologo").val(), tecnico: $("#Presupuesto_tecnico").val(), urovideo: $("#Presupuesto_urovideo").val(), instrumental: $("#Presupuesto_instrumental").val(),
									interconsulta: $("#Presupuesto_interconsulta").val(), total: $("#Presupuesto_total_presupuesto").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_total_presupuesto').val(data.total);
									}

								}",
		                    ))); ?>

			<?php echo $form->textFieldRow($model,'urovideo',array('class'=>'span2','maxlength'=>10, 'ajax' => array(
		                        'type' =>'POST',
		                        'url' => $this->createUrl('presupuesto/ActualizarTotal'),
		                        'data' => 'js:{
									medico: $("#Presupuesto_medico_tratante").val(), cirujano: $("#Presupuesto_cirujano_principal").val(), a1: $("#Presupuesto_ayudante1").val(), a2: $("#Presupuesto_ayudante2").val(),
									anestesiologo: $("#Presupuesto_anestesiologo").val(), tecnico: $("#Presupuesto_tecnico").val(), urovideo: $("#Presupuesto_urovideo").val(), instrumental: $("#Presupuesto_instrumental").val(),
									interconsulta: $("#Presupuesto_interconsulta").val(), total: $("#Presupuesto_total_presupuesto").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_total_presupuesto').val(data.total);
									}

								}",
		                    ))); ?>

			<?php echo $form->textFieldRow($model,'instrumental',array('class'=>'span2','maxlength'=>10, 'ajax' => array(
		                        'type' =>'POST',
		                        'url' => $this->createUrl('presupuesto/ActualizarTotal'),
		                        'data' => 'js:{
									medico: $("#Presupuesto_medico_tratante").val(), cirujano: $("#Presupuesto_cirujano_principal").val(), a1: $("#Presupuesto_ayudante1").val(), a2: $("#Presupuesto_ayudante2").val(),
									anestesiologo: $("#Presupuesto_anestesiologo").val(), tecnico: $("#Presupuesto_tecnico").val(), urovideo: $("#Presupuesto_urovideo").val(), instrumental: $("#Presupuesto_instrumental").val(),
									interconsulta: $("#Presupuesto_interconsulta").val(), total: $("#Presupuesto_total_presupuesto").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_total_presupuesto').val(data.total);
									}

								}",
		                    ))); ?>

			<?php echo $form->textFieldRow($model,'interconsulta',array('class'=>'span2','maxlength'=>10, 'ajax' => array(
		                        'type' =>'POST',
		                        'url' => $this->createUrl('presupuesto/ActualizarTotal'),
		                        'data' => 'js:{
									medico: $("#Presupuesto_medico_tratante").val(), cirujano: $("#Presupuesto_cirujano_principal").val(), a1: $("#Presupuesto_ayudante1").val(), a2: $("#Presupuesto_ayudante2").val(),
									anestesiologo: $("#Presupuesto_anestesiologo").val(), tecnico: $("#Presupuesto_tecnico").val(), urovideo: $("#Presupuesto_urovideo").val(), instrumental: $("#Presupuesto_instrumental").val(),
									interconsulta: $("#Presupuesto_interconsulta").val(), total: $("#Presupuesto_total_presupuesto").val()
								}',
								'dataType'=>'json',
								'success' => "js: function(data) {

									if(data.success){
										$('#Presupuesto_total_presupuesto').val(data.total);
									}

								}",
		                    ))); ?>
	</body>

	</section>

	<?php echo $form->textFieldRow($model,'total_presupuesto',array('class'=>'span2', 'readonly'=>'readonly')); ?>

	<?php echo $form->textAreaRow($model,'observaciones',array('class'=>'span12','maxlength'=>250, 'rows'=>3)); ?>

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

		<?php $this->renderPartial('grid_buscar_paciente', array('model' => new Paciente('search'))); ?>

	<?php $this->endWidget(); ?>

<?php $this->endWidget(); ?>
