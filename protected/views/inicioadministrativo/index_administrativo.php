<?php
/* @var $this SiteController */

	$this->pageTitle=Yii::app()->name;

	$this->menu=array(
		array('label'=>'Crear Cita','url'=>array('createCita')),
	);

?>

<h1>¡Hola <?php echo Yii::app()->user->getState('nombre').' '.Yii::app()->user->getState('apellido'); ?>!</h1>

<p>Por defecto se presentan las citas programadas para hoy. Si deseas consultar otras fechas, selecciona la fecha que desees en el campo "Fecha de la Cita", o si prefiere filtrar por otro campo.</p>

<div class="clear">&nbsp;</div>

<?php

	$this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'cita-grid',
		'dataProvider'=>$model->search(),
		//'type'=>'condensed',
		'filter'=>$model,
		'template'=>'{summary}{items}{pager}{summary}',
		'afterAjaxUpdate'=>'function(id, data){hide_column(); reinstallDatePicker();}',
		'columns'=>array(
			'fecha_cita'=>array(
				'name'=>'fecha_cita',
				'value'=>'Funciones::invertirFecha($data->fecha_cita)',
				'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker',
						array(
							 'id' => CHtml::getIdByName(get_class($model).'[fecha_cita]'),
							 'name'=>'cita_fecha_cita',
							 'language'=>'es',
							 'model' => $model,
							 'value' => Funciones::invertirFecha($model->fecha_cita),
							 'attribute'=>'fecha_cita',
							 'htmlOptions' => array('class'=>'span2', 'readonly'=>'readonly'),
							 'defaultOptions' => array(
								 'showAnim'=>'slideDown',
								 'showButtonPanel' => 'true',
								 'changeMonth'=>true,
								 'changeYear'=>true,
								 'yearRange'=>'1920:'.date('Y'),
								 'autoSize'=>true,
								 'dateFormat'=>'dd-mm-yy',
								 'constrainInput' => 'true'
							 )
						),true
					),
				),
			'cedulaPaciente',
			'nombrePaciente'=>array(
				'name'=>'nombrePaciente',
				'header'=>'Paciente',
				'value'=>'$data->nombrePaciente',
			),
			//SE COLOCA ESTE FILTRO (nombreDoctor) COMO COMPLEMENTO, JUNTO CON EL SIGUIENTE FILTRO PARA QUE FUNCIONE EL FILTRO CON COMBO DE DOCTOR.
			'nombreDoctor',
			'doctor_id'=>array(
				'name'=>'doctor_id',
				'value'=>'$data->nombreDoctor',
				'filter'=>CHtml::listData(Usuario::model()->findAll(array('order' => 'nombre_usuario, apellido_usuario', 'condition' => 'tipo_usuario_id = 2 or tipo_usuario_id = 3')), 'usuario_id','nombreCompleto')
			),
			array('header'=>'Orden', 'name'=>'orden_cita', 'value'=>'$data->orden_cita', 'filter'=>false),
			array('header'=>'Estado', 'name'=>'descripcionEstadoCita', 'filter'=>false, 'cssClassExpression'=>'$data->get_ClaseEtiqueta()', 'htmlOptions'=>array('style'=>'width: 80px; text-align: center;')),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'htmlOptions'=>array('style'=>'width: 102px;'),
				'template'=>'{up}{down}{estatus}',
				'buttons'=>array(
					'up'=>array(
						'label'=>'Subir Orden',
						'icon'=>'icon-arrow-up',
						'options'=>array('style'=>'margin-left: 3px;'),
					),
					'down'=>array(
						'label'=>'Bajar Orden',
						'icon'=>'icon-arrow-down',
						'options'=>array('style'=>'margin-left: 3px;'),
					),
					'estatus'=>array(
						'label'=>'Cambiar Estado de la Cita',
						'icon'=>'icon-step-forward',
						'options'=>array('style'=>'margin-left: 3px;'),
						'url'=>'Yii::app()->createUrl("inicioadministrativo/cambiarestadocita", array("Cita_ID" => $data->cita_id))',
						'click' => "function(e){

							e.preventDefault();

							$.ajax({
								url: $(this).attr('href'),
								type: 'post',
								dataType: 'json',
								success: function(data) {

									if(data !=null && data.retorno){
										$.fn.yiiGridView.update('cita-grid');
									}

									showAlertAnimatedToggled(data.retorno, '', 'Estatus cambiado satisfactoriamente.', '', 'No se pudo cambiar el estatus. Consulte a su administrador de sistemas.');
								}
							});

						}",
					),
				)
			),
		),
	));

	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$("#info").delay(5000).fadeOut("slow");',
	   CClientScript::POS_READY
	);

?>
<script type="text/javascript">

	//OCULTA LA COLUMNA DE NOMBRE DOCTOR PARA QUE PUEDA TRABAJAR EL FILTRO BIEN.
	function hide_column(){
	    grid = $('#cita-grid');
	    $('tr', grid).each(function() {
	        $('td:eq(3), th:eq(3)',this).hide();
	    });
	}

	//RECONFIGURA EL DATE TIME PICKER CADA VEZ QUE SE CARGA EL GRID
	function reinstallDatePicker(){
		$('#Cita_fecha_cita').datepicker(
			jQuery.extend({showMonthAfterYear:false},
			jQuery.datepicker.regional['es'],{'dateFormat':'dd-mm-yy'})
		);
	}

	$( document ).ready(function() {

		$(hide_column());
		$(reinstallDatePicker());
	});

</script>