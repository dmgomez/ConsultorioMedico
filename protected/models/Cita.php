<?php

Yii::import("ext.FuncionesGenerales");

/**
 * This is the model class for table "cita".
 *
 * The followings are the available columns in table 'cita':
 * @property string $cita_id
 * @property string $fecha_cita
 * @property string $paciente_id
 * @property integer $orden_cita
 * @property integer $doctor_id
 * @property string $usuario_id
 * @property integer $origen_cita
 * @property string $estado_cita_id
 * @property string $observacion_cita
 *
 * The followings are the available model relations:
 * @property Usuario $doctor
 * @property EstadoCita $estadoCita
 * @property Paciente $paciente
 * @property Usuario $usuario
 */
class Cita extends CActiveRecord
{

	private $_cedulaPaciente;
	private $_nombrePaciente;
	private $_nombreDoctor;
	private $_descripcionEstadoCita;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cita';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('fecha_cita, cedulaPaciente, paciente_id, doctor_id', 'required'),
			array('observacion_cita', 'length', 'max'=>150),
			array('fecha_cita','ValidarFecha', 'on'=>array('insert')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fecha_cita, cedulaPaciente, nombrePaciente, nombreDoctor, descripcionEstadoCita, observacion_cita, doctor_id, estado_cita_id', 'safe', 'on'=>'search'),
		);
	}

	/*
	* Valida que la fecha de la cita no sea menor a la actual
	*/
	public function ValidarFecha($attribute){

		$today = new DateTime();
		$fecha = new DateTime($this->fecha_cita);

		if( ($fecha < $today) && ($fecha->format('Y-m-d') <> $today->format('Y-m-d')) ){

			$this->addError($attribute,"La fecha de la cita no puede ser menor a la fecha actual.");
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'doctor' => array(self::BELONGS_TO, 'Usuario', 'doctor_id'),
			'estadoCita' => array(self::BELONGS_TO, 'EstadoCita', 'estado_cita_id'),
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fecha_cita' => 'Fecha de la Cita',
			'paciente_id' => 'Paciente',
			'_cedulaPaciente' => 'Cédula Paciente',
			'_nombrePaciente' => 'Paciente',
			'orden_cita' => 'Orden Cita',
			'doctor_id' => 'Doctor',
			'_nombreDoctor' => 'Doctor',
			'estado_cita_id' => 'Estado Cita',
			'_descripcionEstadoCita' => 'Estado Cita',
			'observacion_cita' => 'Observación Cita',
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
		$criteria->with = array("paciente", "estadoCita", "doctor");

		$criteria->compare('t.fecha_cita',Funciones::invertirFecha($this->fecha_cita),true);
		$criteria->compare('t.doctor_id',$this->doctor_id, true);
		$criteria->compare('paciente.cedula_paciente',$this->cedulaPaciente,true);
		$criteria->compare('paciente.nombre_paciente',$this->nombrePaciente,true);
		$criteria->compare('paciente.apellido_paciente',$this->nombrePaciente,true, 'OR');
		$criteria->compare('CONCAT(paciente.nombre_paciente," ",paciente.apellido_paciente)',$this->nombrePaciente,true, 'OR');
		$criteria->compare('doctor.nombre_usuario',$this->nombreDoctor,true);
		$criteria->compare('doctor.apellido_usuario',$this->nombreDoctor,true, 'OR');
		$criteria->compare('estadoCita.descripcion_estado_cita',$this->descripcionEstadoCita,true);
		$criteria->compare('t.observacion_cita',$this->observacion_cita,true);

		$sort = new CSort();
		$sort->attributes = array(

		    'fecha_cita'=>array(
		        'asc'=>'t.fecha_cita',
		        'desc'=>'t.fecha_cita desc',
		    ),
		    'doctor_id'=>array(
		        'asc'=>'t.doctor_id',
		        'desc'=>'t.doctor_id desc',
		    ),
		    'cedulaPaciente'=>array(
		        'asc'=>'paciente.cedula_paciente',
		        'desc'=>'paciente.cedula_paciente desc',
		    ),
		    'nombrePaciente'=>array(
		        'asc'=>'paciente.nombre_paciente',
		        'desc'=>'paciente.nombre_paciente desc',
		    ),
		    'nombreDoctor'=>array(
		        'asc'=>'doctor.nombre_usuario',
		        'desc'=>'doctor.nombre_usuario desc',
		    ),
		    'descripcionEstadoCita'=>array(
		        'asc'=>'estadoCita.descripcion_estado_cita',
		        'desc'=>'estadoCita.descripcion_estado_cita desc',
		    ),
		    'observacion_cita'=>array(
		        'asc'=>'t.observacion_cita',
		        'desc'=>'t.observacion_cita desc',
		    ),
		);

		$sort->defaultOrder = 't.fecha_cita DESC, t.doctor_id ASC, t.orden_cita ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cita the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*GET redefinido para acceder a los campos virtuales agregados*/
	public function getdescripcionEstadoCita(){

	    if ($this->_descripcionEstadoCita === null && $this->estadoCita !== null){

	        $this->_descripcionEstadoCita = $this->estadoCita->descripcion_estado_cita;
	    }

	    return $this->_descripcionEstadoCita;
	}

	/*SET redefinido para acceder a los campos virtuales agregados*/
	public function setdescripcionEstadoCita($value){

		$this->_descripcionEstadoCita = $value;
	}

	/*GET redefinido para acceder a los campos virtuales agregados*/
	public function getcedulaPaciente(){

	    if ($this->_cedulaPaciente === null && $this->paciente !== null){

	        $this->_cedulaPaciente = $this->paciente->cedula_paciente;
	    }

	    return $this->_cedulaPaciente;
	}

	/*SET redefinido para acceder a los campos virtuales agregados*/
	public function setcedulaPaciente($value){

		$this->_cedulaPaciente = $value;
	}

	/*GET redefinido para acceder a los campos virtuales agregados*/
	public function getnombrePaciente(){

	    if ($this->_nombrePaciente === null && $this->paciente !== null){

	        $this->_nombrePaciente = $this->paciente->nombre_paciente.' '.$this->paciente->apellido_paciente;
	    }

	    return $this->_nombrePaciente;
	}

	/*SET redefinido para acceder a los campos virtuales agregados*/
	public function setnombrePaciente($value){

		$this->_nombrePaciente = $value;
	}

	/*GET redefinido para acceder a los campos virtuales agregados*/
	public function getnombreDoctor(){

	    if ($this->_nombreDoctor === null && $this->doctor !== null){

	        $this->_nombreDoctor = $this->doctor->nombre_usuario.' '.$this->doctor->apellido_usuario;
	    }

	    return $this->_nombreDoctor;
	}

	/*SET redefinido para acceder a los campos virtuales agregados*/
	public function setnombreDoctor($value){

		$this->_nombreDoctor = $value;
	}

	public function get_strFechaCita(){

		return Funciones::invertirFecha($this->fecha_cita);
	}

	public function get_ClaseEtiqueta(){

		$ID = $this->estado_cita_id;

		$etiqueta = 'label';

		switch ($ID) {
			case 1:

				$etiqueta = 'label label-defult';
				break;

			case 2:

				$etiqueta = 'label label-info';
				break;

			case 3:

				$etiqueta = 'label label-success';
				break;

			case 4:

				$etiqueta = 'label label-important';
				break;

			case 5:

				$etiqueta = 'label label-warning';
				break;
		}

		return $etiqueta;
	}

}