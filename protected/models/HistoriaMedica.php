<?php

/**
 * This is the model class for table "historia_medica".
 *
 * The followings are the available columns in table 'historia_medica':
 * @property integer $historia_medica_id
 * @property string $paciente_id
 * @property string $consulta_id
 * @property string $referido
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property Consulta $consulta
 */
class HistoriaMedica extends CActiveRecord
{

	private $_cedulaPaciente;
	private $_nombrePaciente;
	private $_edadPaciente;
	private $_fechaNacimiento;
	private $_lugarNacimiento;
	private $_estadoCivil;
	private $_direccion;
	private $_telefonoHabitacion;
	private $_telefonoCelular;
	private $_seguro;
	private $_profesion;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historia_medica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('historia_medica_id, paciente_id, cedulaPaciente, nombrePaciente', 'required'),
			array('historia_medica_id', 'numerical', 'integerOnly'=>true),
			array('paciente_id, consulta_id', 'length', 'max'=>10),
			array('referido', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('historia_medica_id, paciente_id, consulta_id, referido', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
			'consulta' => array(self::BELONGS_TO, 'Consulta', 'consulta_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'historia_medica_id' => 'Historia Médica',
			'paciente_id' => 'Paciente',
			'cedulaPaciente' => 'Cédula Paciente',
			'nombrePaciente' => 'Paciente',
			'edad' => 'Edad Paciente',
			'fechaNacimiento' => 'Fecha de Nacimiento',
			'lugarNacimiento' => 'Lugar de Nacimiento',
			'estadoCivil' => 'Estado Civil',
			'direccion' => 'Dirección',
			'telefonoHabitacion' => 'Teléfono Habitación',
			'telefonoCelular' => 'Teléfono Celular',
			'seguro' => 'Seguro',
			'profesion' => 'Profesión',
			'consulta_id' => 'Consulta',
			'referido' => 'Referido',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('historia_medica_id',$this->historia_medica_id);
		$criteria->compare('paciente_id',$this->paciente_id,true);
		$criteria->compare('paciente.cedula_paciente',$this->cedulaPaciente,true);
		$criteria->compare('paciente.nombre_paciente',$this->nombrePaciente,true);
		$criteria->compare('paciente.apellido_paciente',$this->nombrePaciente,true, 'OR');
		$criteria->compare('CONCAT(paciente.nombre_paciente," ",paciente.apellido_paciente)',$this->_nombrePaciente,true, 'OR');
		$criteria->compare('consulta_id',$this->consulta_id,true);
		$criteria->compare('referido',$this->referido,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistoriaMedica the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getcedulaPaciente(){

	    if ($this->_cedulaPaciente === null && $this->paciente !== null){

	        $this->_cedulaPaciente = $this->paciente->cedula_paciente;
	    }

	    return $this->_cedulaPaciente;
	}

	public function setcedulaPaciente($value){

		$this->_cedulaPaciente = $value;
	}

	public function getnombrePaciente(){

	    if ($this->_nombrePaciente === null && $this->paciente !== null){

	        $this->_nombrePaciente = $this->paciente->nombre_paciente.' '.$this->paciente->apellido_paciente;
	    }

	    return $this->_nombrePaciente;
	}

	public function setnombrePaciente($value){

		$this->_nombrePaciente = $value;
	}

	public function getedadPaciente(){

	    if ($this->_edadPaciente === null && $this->paciente !== null){

	        $anyoN = date("Y", strtotime($this->paciente->fecha_nacimiento));
	        $mesN = date("m", strtotime($this->paciente->fecha_nacimiento)); 
	        $diaN = date("d", strtotime($this->paciente->fecha_nacimiento)); 

	        $anyoA = date("Y");
	        $mesA = date("m");
	        $diaA = date("d");

	        $this->_edadPaciente = $anyoA - $anyoN;

	        if($mesA < $mesN || ( ($mesA==$mesN) && ($diaN >= $diaA) ) )
	        {
	        	$this->_edadPaciente -= 1;
	        }
	       
	    }

	    return $this->_edadPaciente;
	}

	public function setedadPaciente($value){

		$this->_edadPaciente = $value;
	}

	public function getfechaNacimiento(){

	    if ($this->_fechaNacimiento === null && $this->paciente !== null){

	        $this->_fechaNacimiento = $this->paciente->fecha_nacimiento;
	    }

	    return $this->_fechaNacimiento;
	}

	public function setfechaNacimiento($value){

		$this->_fechaNacimiento = $value;
	}

	public function getlugarNacimiento(){

	    if ($this->_lugarNacimiento === null && $this->paciente !== null){

	        $this->_lugarNacimiento = $this->paciente->lugar_nacimiento;
	    }

	    return $this->_lugarNacimiento;
	}

	public function setlugarNacimiento($value){

		$this->_lugarNacimiento = $value;
	}

	public function getestadoCivil(){

	    if ($this->_estadoCivil === null && $this->paciente !== null){

	        $this->_estadoCivil = $this->paciente->estado_civil_id;

	        $edoCivil=EstadoCivil::model()->findByPk($this->_estadoCivil);
			$this->_estadoCivil=$edoCivil->descripcion_estado_civil;
	    }

	    return $this->_estadoCivil;
	}

	public function setestadoCivil($value){

		$this->_estadoCivil = $value;
	}

	public function getdireccion(){

	    if ($this->_direccion === null && $this->paciente !== null){

	        $this->_direccion = $this->paciente->direccion_paciente;
	    }

	    return $this->_direccion;
	}

	public function setdireccion($value){

		$this->_direccion = $value;
	}

	public function gettelefonoHabitacion(){

	    if ($this->_telefonoHabitacion === null && $this->paciente !== null){

	        $this->_telefonoHabitacion = $this->paciente->telefono_habitacion;
	    }

	    return $this->_telefonoHabitacion;
	}

	public function settelefonoHabitacion($value){

		$this->_telefonoHabitacion = $value;
	}

	public function gettelefonoCelular(){

	    if ($this->_telefonoCelular === null && $this->paciente !== null){

	        $this->_telefonoCelular = $this->paciente->telefono_celular;
	    }

	    return $this->_telefonoCelular;
	}

	public function settelefonoCelular($value){

		$this->_telefonoCelular = $value;
	}

	public function getseguro(){

	    if ($this->_seguro === null && $this->paciente !== null){

	        $this->_seguro = $this->paciente->seguro_id;

	        $nombreSeguro=Seguro::model()->findByPk($this->_seguro);
			$this->_seguro=$nombreSeguro->nombre_seguro;
	    }

	    return $this->_seguro;
	}

	public function setseguro($value){

		$this->_seguro = $value;
	}

	public function getprofesion(){

	    if ($this->_profesion === null && $this->paciente !== null){

	        $this->_profesion = $this->paciente->profesion_paciente;
	    }

	    return $this->_profesion;
	}

	public function setprofesion($value){

		$this->_profesion = $value;
	}
}
