<div>

    <div class="modal-header">
        <h2>Buscar Paciente</h2>
    </div> 

	<div class="modal-body">

		<p>
			Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
		</p>

		<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'paciente-grid',
			'dataProvider'=>$model->search(),
			'type'=>'striped',
			'template'=>'{summary}{items}{pager}{summary}',	
			'filter'=>$model,
			'columns'=>array(
				'cedula_paciente',
				'nombre_paciente',
				'apellido_paciente',
				array(

					'class'=>'CButtonColumn',	
					'template' => '{select}',		
					'buttons' => array(
						'select' => array(
							'label' => 'Seleccionar', 
							'options' => array('title' => 'Selecciona el registro indicado.', 'class' => 'btn btn-inverse'),
							'type' => 'inverse',
							'url'=>'Yii::app()->createUrl("historiaMedica/buscarpacienteporid", array("ID"=>$data->paciente_id))',
							'click' => "function(e){

								e.preventDefault();

								$.ajax({
									url: $(this).attr('href'), 
									type: 'post',
									dataType: 'json',
									success: function(data) { 						

										if(data.success){
											$('#HistoriaMedica_cedulaPaciente').val(data.cedula);
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
											$('#HistoriaMedica_cedulaPaciente').val('');
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

										showAlertAnimatedToggled(data.success, 'Paciente seleccionado.', data.paciente, 'Error', 'No se encuentra ningun paciente con esa cédula.');										
									}									
								});								

								$('#buscar-paciente').modal('hide');								
							}",
						)
					),
				),
			),
		)); ?>

	</div>

    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cerrar</a>	
    </div>

</div>