<?php
/**
* 	CLASE DE FUNCIONES GENERALES
*/
class Funciones{


	/*
	* @return Invierte el sentido de la cadena que representa a la fecha. Bien para mostrarla en el
	* formato regional adecuado o para ingresarla a la Base de Datos.
	*/

	public static function invertirFecha($fecha){

		return implode( "-", array_reverse( preg_split( '/-/', $fecha ) ) );
	}

	public static function generarCabecera($ubicacion_logo, $titulo_reporte, $subtitulo_1, $subtitulo_2, $subtitulo_3, $subtitulo_4){


		if (isset($ubicacion_logo))
		{
			$logo=Yii::app()->request->baseUrl.'/data_img/logos/'.$ubicacion_logo;

			$cabecera = '<table width="100%">
			 		<tr>
			 			<td width="35%"><img width="180" style="max-height: 200px" src="'.$logo.'"/></td>
			 			<td width="65%" align="left">
			 				<table>';
			 				if (isset($titulo_reporte))
			 				{
			 					$cabecera.='
			 					<tr>
			 						<td style="font-size: 14pt" align="center"><b>'.$titulo_reporte.'</b></td>
			 					</tr>';
			 				}
			 				if (isset($subtitulo_1))
			 				{
			 					$cabecera.='
			 					<tr>
			 						<td style="font-size: 12pt" align="center">'. $subtitulo_1 .'</td>
			 					</tr>';
			 				}
			 				if (isset($subtitulo_2))
			 				{
			 					$cabecera.='
			 					<tr>
			 						<td style="font-size: 10pt" align="center">'.$subtitulo_2.'</td>
			 					</tr>';
			 				}
			 				if (isset($subtitulo_3))
			 				{
			 					$cabecera.='
			 					<tr>
			 						<td style="font-size: 10pt" align="center">'.$subtitulo_3.'</td>
			 					</tr>';
			 				}
			 				if (isset($subtitulo_4))
			 				{
			 					$cabecera.='
			 					<tr>
			 						<td style="font-size: 10pt" align="center">'.$subtitulo_4.'</td>
			 					</tr>';
			 				}
			 				$cabecera.='
			 				</table>
			 			</td>
			 		</tr>
			 	</table>';

			return $cabecera;
		}

	}

	public static function omitirIcono($diagnostico){

		$diagnosticoNuevo="";

		$diagnosticoTemp = explode("<", $diagnostico);
		for ($i=0; $i < count($diagnosticoTemp); $i++) 
		{ 
		 	$subdiagnosticoTemp = explode(">", $diagnosticoTemp[$i]);
		 	for ($j=0; $j < count($subdiagnosticoTemp); $j++) 
		 	{ 
		 		$coincidencia = strpos($subdiagnosticoTemp[$j], 'label');
		 		$coincidencia2 = strpos($subdiagnosticoTemp[$j], 'img');
 
				if ($coincidencia === false && $coincidencia2 === false && $subdiagnosticoTemp[$j] != "") 
				{
				    $diagnosticoNuevo.=$subdiagnosticoTemp[$j].', ';
		 		}
		 	}
		}

		$diagnosticoNuevo=substr($diagnosticoNuevo, 0, -2);

		return $diagnosticoNuevo;
	}
}
?>