<?php

class BarraMenu{

	private $_tipoUsuario;

	public function BarraMenu($id)
	{
		$this->_tipoUsuario = $id;
	}

	public function get_tipoUsuario($value){

		$this->_tipoUsuario = $valor;
	}

	public function set_tipoUsuario(){

		return $this->_tipoUsuario;
	}

	public function CrearMenu(){

		switch ($this->_tipoUsuario) {

			//	USUARIO ADMINISTRADOR
			case 1:

				$result =	array(
				                array('label'=>'Inicio', 'url'=>array('/Inicio/index')),
				                array('label'=>'Configuración', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Usuarios', 'url'=>array('/Usuario/index')),
				                        '---',
				                        array('label'=>'Patologías', 'url'=>array('/Patologia/index')),
				                        array('label'=>'Fármacos', 'url'=>array('/Farmaco/index')),
				                        array('label'=>'Presentaciones', 'url'=>array('/Presentacion/index')),
				                        array('label'=>'Seguros', 'url'=>array('/Seguro/index')),
				                        array('label'=>'Cabecera Reportes', 'url'=>array('/ConfiguracionReporte/index')),
				                    )
				                ),
				                array('label'=>'Administración', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Pacientes', 'url'=>array('/Paciente/index')),
				                        '---',
				                        array('label'=>'Citas', 'url'=>array('/Cita/index')),
				                        array('label'=>'Presupuestos', 'url'=>array('/Presupuesto/index')),
				                    )
				                ),
				                array('label'=>'Operativo', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Historias', 'url'=>array('/Historia/index')),
				                        array('label'=>'Consultas (Temporalmente)', 'url'=>array('/Consulta/index')),
				                        array('label'=>'Estudio Médico', 'url'=>array('/Estudio/index')),
				                    )
				                ),
				                array('label'=>'Reportes', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Reporte de Citas', 'url'=>array('/Reportes/reporteCitas')),
				                        array('label'=>'Reporte de Pacientes', 'url'=>array('/Reportes/reportePacientes')),
				                        array('label'=>'Reporte de Consultas', 'url'=>array('/Reportes/reporteConsultas')),
				                        array('label'=>'Reporte de Estadisticas de Patologias', 'url'=>array('/Reportes/reporteEstadisticasPatologias')),
				                        array('label'=>'Reporte de Estadisticas Doctores', 'url'=>array('/Reportes/reporteEstadisticasDoctores')),
				                    )
				                ),
			            	);

				break;

			//	USUARIO DOCTOR AVANZADO
			case 2:

				$result =	array(
				                array('label'=>'Inicio', 'url'=>array('/Inicio/index')),
				                array('label'=>'Configuración', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Usuarios', 'url'=>array('/Usuario/index')),
				                        '---',
				                        array('label'=>'Patologías', 'url'=>array('/Patologia/index')),
				                        array('label'=>'Fármacos', 'url'=>array('/Farmaco/index')),
				                        array('label'=>'Presentaciones', 'url'=>array('/Presentacion/index')),
				                        array('label'=>'Seguros', 'url'=>array('/Seguro/index')),
				                    )
				                ),
				                array('label'=>'Administración', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Pacientes', 'url'=>array('/Paciente/index')),
				                        '---',
				                        array('label'=>'Citas', 'url'=>array('/Cita/index')),
				                        array('label'=>'Presupuestos', 'url'=>array('/Presupuesto/index')),
				                    )
				                ),
				                array('label'=>'Reportes', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Reporte de Citas', 'url'=>array('/Usuario/index')),
				                        array('label'=>'Reporte de Pacientes', 'url'=>array('/Usuario/index')),
				                        array('label'=>'Reporte de Consultas', 'url'=>array('/Usuario/index')),
				                        array('label'=>'', 'url'=>array('/Usuario/index')),
				                    )
				                ),
			            	);

				break;

			//	USUARIO DOCTOR
			case 3:

				$result =	array(
				                array('label'=>'Inicio', 'url'=>array('/Inicio/index')),
				                array('label'=>'Configuración', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Patologías', 'url'=>array('/Patologia/index')),
				                        array('label'=>'Fármacos', 'url'=>array('/Farmaco/index')),
				                        array('label'=>'Presentaciones', 'url'=>array('/Presentacion/index')),
				                    )
				                ),
				                array('label'=>'Operación', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Examen de Rutina', 'url'=>array('/Historia/index')),
				                    )
				                ),
				                array('label'=>'Reportes', 'url'=>'#',
				                    'items'=>array(
				                        array('label'=>'Reporte de Citas', 'url'=>array('/Usuario/index')),
				                        array('label'=>'Reporte de Pacientes', 'url'=>array('/Usuario/index')),
				                        array('label'=>'Reporte de Consultas', 'url'=>array('/Usuario/index')),
				                        array('label'=>'', 'url'=>array('/Usuario/index')),
				                    )
				                ),
			            	);

				break;
			case 4:


				break;
			case 5:
				# code...
				break;
			case 6:

				break;
		}

		return $result;
	}

}

?>