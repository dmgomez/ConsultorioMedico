<html>
	<head>
		<style>
		 body {font-family: sans-serif;
		 font-size: 10pt;
		 }
		 p { margin: 0pt;
		 }

		</style>
	</head>
	<body style="background: transparent url('<?php echo Yii::app()->request->baseUrl.'/data_img/pdf/fondo.png'?>') repeat fixed right top; padding: 1em; ">
	
		<htmlpageheader name="myheader">
		 	<?php 
		 	$formatoCabecera=Funciones::generarCabecera($cabecera['ubicacion_logo'], $cabecera['titulo_reporte'], $cabecera['subtitulo_1'], $cabecera['subtitulo_2'], $cabecera['subtitulo_3'], $cabecera['subtitulo_4']);
		 	echo $formatoCabecera; 
		 	?>
		</htmlpageheader>
		 
		<htmlpagefooter name="myfooter">
		 	<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
		 		Página {PAGENO} de {nb}
		 	</div>
		</htmlpagefooter>

		<htmlpagebody name="mybody">
			<br><br><br>
			
			<div style="text-align: right">
				<b>Fecha: </b> <?php echo $model->fecha_presupuesto; ?> 
			</div>
			<div style="text-align: center"><b>Presupuesto</b></div>
			<br>
			<div >

				<div style="text-align: left" id="datos-paciente">
					<p><b>Datos del Paciente:</b></p>
					<p>&nbsp;&nbsp;&nbsp;Cédula: <?php echo $model->cedulaPaciente; ?></p>
					<p>&nbsp;&nbsp;&nbsp;Nombre: <?php echo $model->nombrePaciente; ?></p>
					<p>&nbsp;&nbsp;&nbsp;Edad: <?php echo $model->edadPaciente; ?></p>
					<?php if($model->condicion != "") { ?>
						<p>&nbsp;&nbsp;&nbsp;Condición: <?php echo $model->condicion; ?></p>
					<?php } ?>
				</div>

				<br>
				<div style="text-align: left" id="datos-clinicos">
					<p><b>Datos Clínicos:</b></p>
					<p>&nbsp;&nbsp;&nbsp;Diagnóstico: <?php echo $model->diagnostico; ?></p>
					<p>&nbsp;&nbsp;&nbsp;Intervención o tratamiento: <?php echo $model->intervencion_tramiento; ?></p>
					<p>&nbsp;&nbsp;&nbsp;Días de Hospitalización: <?php echo $model->dias_hospitalizacion; ?></p>
				</div>

				<br>
				<div style="text-align: left" id="estudios-requeridos">
					<p><b>Estudios Requeridos:</b> </p>
					<?php if($model->rutinaLaboratorio == "SI") { ?>
						<p>&nbsp;&nbsp;&nbsp;- Rutina de Laboratirio</p>
					<?php } ?>
					<?php if($model->teleTorax == "SI") { ?>
						<p>&nbsp;&nbsp;&nbsp;- Tele Tórax</p>
					<?php } ?>
					<?php if($model->biopsiaP == "SI") { ?>
						<p>&nbsp;&nbsp;&nbsp;- Biopsia</p>
					<?php } ?>
					<?php if($model->cardiovascularP == "SI") { ?>
						<p>&nbsp;&nbsp;&nbsp;- Cardiovascular</p>
					<?php } ?>		
					<?php if($model->otros_examenes != "") { ?>
						<p>&nbsp;&nbsp;&nbsp;- Otros Exámenes: <?php echo $model->otros_examenes; ?></p>
					<?php } ?>	
				</div>

				<br>
				<div style="text-align: left" id="honorarios">
					<p><b>Honorarios:</b> </p>
					<?php if($model->medico_tratante != '0') { ?>
						<p>&nbsp;&nbsp;&nbsp;Médico Tratante: <?php echo number_format($model->medico_tratante,2,',','.'); ?></p>
					<?php } ?>
					<?php if($model->cirujano_principal != '0') { ?>
						<p>&nbsp;&nbsp;&nbsp;Cirujano Principal: <?php echo number_format($model->cirujano_principal,2,',','.'); ?></p>
					<?php } ?>
					<?php if($model->ayudante1 != '0') { ?>
						<p>&nbsp;&nbsp;&nbsp;Ayudante 1: <?php echo number_format($model->ayudante1,2,',','.'); ?></p>
					<?php } ?>
					<?php if($model->ayudante2 != '0') { ?>
						<p>&nbsp;&nbsp;&nbsp;Ayudante 2: <?php echo number_format($model->ayudante2,2,',','.'); ?></p>	
					<?php } ?>
					<?php if($model->anestesiologo != '0') { ?>
						<p>&nbsp;&nbsp;&nbsp;Anestesiólogo: <?php echo number_format($model->anestesiologo,2,',','.'); ?></p>
					<?php } ?>
					<?php if($model->tecnico != '0') { ?>
						<p>&nbsp;&nbsp;&nbsp;Técnico: <?php echo number_format($model->tecnico,2,',','.'); ?></p>
					<?php } ?>
					<?php if($model->urovideo != '0') { ?>
						<p>&nbsp;&nbsp;&nbsp;Urovideo: <?php echo number_format($model->urovideo,2,',','.'); ?></p>
					<?php } ?>
					<?php if($model->instrumental != '0') { ?>
						<p>&nbsp;&nbsp;&nbsp;Instrumental: <?php echo number_format($model->instrumental,2,',','.'); ?></p>		
					<?php } ?>
					<?php if($model->interconsulta != '0') { ?>
						<p>&nbsp;&nbsp;&nbsp;Interconsulta: <?php echo number_format($model->interconsulta,2,',','.'); ?></p>
					<?php } ?>
				
				</div>

				
				<?php
				if($model->observaciones != "")
				{
				?>
					<br>
					<div style="text-align: left" id="observaciones">
						<p><b>Observaciones</b> </p>
						<p>&nbsp;&nbsp;&nbsp;<?php echo $model->observaciones; ?></p>	
					</div>
				<?php
				}
				?>		

				<br>
				<div style="text-align: right" id="total">
					<p><b>Total del Presupuesto: </b> <?php echo  number_format($model->total_presupuesto,2,',','.'); ?></p>
				</div>

				<br><br>
				<div style="text-align: center" id="total">
					<p><b>Firma y Sello: </b> <br></p>
					<p><br><br><br><br><br><br>________________________________ </p>
				</div>

				
			</div>
		</htmlpagebody>

		<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
		<sethtmlpagebody name="mybody" value="on" />
		<sethtmlpagefooter name="myfooter" value="on" />

	 </body>
 </html>
