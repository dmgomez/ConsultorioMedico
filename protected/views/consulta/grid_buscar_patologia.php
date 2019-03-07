<div>

    <div class="modal-header">
        <h2>Buscar Patología</h2>
    </div> 

	<div class="modal-body">

		<p>
			Utilice las cajas de texto correspondiente a cada campo y presione "Enter" para filtrar los registros.
		</p>

		<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'patologia-grid',
			'dataProvider'=>$model->search(),
			'type'=>'striped',
			'template'=>'{summary}{items}{pager}{summary}',	
			'filter'=>$model,
			'columns'=>array(
				'descripcion_patologia',
				array(

					'class'=>'CButtonColumn',	
					'template' => '{select}',		
					'buttons' => array(
						'select' => array(
							'label' => 'Seleccionar', 
							'options' => array('title' => 'Selecciona el registro indicado.', 'class' => 'btn btn-inverse'),
							'type' => 'inverse',
							'url'=>'Yii::app()->createUrl("consulta/BuscarPatologiaPorId", array("ID"=>$data->patologia_id))',
							'click' => "function(e){

								e.preventDefault();

								$.ajax({
									url: $(this).attr('href'), 
									type: 'post',
									data: { patologiasAgregadas: $('#Consulta_diagnosticoId').val() },
									dataType: 'json',
									success: function(data) { 						

										if(data.success){
											if ( $('#nuevasPatologias').html() == '' ) 
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
											
										}

										showAlertAnimatedToggled(data.success, 'Patologia seleccionada.', 'Se ha seleccionado '+data.descripcion, 'Error', data.mensaje);										
									}									
								});								

								$('#buscar-patologia').modal('hide');								
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