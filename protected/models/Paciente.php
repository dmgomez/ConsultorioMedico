<?php

date_default_timezone_set('America/Caracas');

/**
 * This is the model class for table "paciente".
 *
 * The followings are the available columns in table 'paciente':
 * @property string $paciente_id
 * @property string $nombre_paciente
 * @property string $apellido_paciente
 * @property string $cedula_paciente
 * @property string $direccion_paciente
 * @property string $telefono_habitacion
 * @property string $telefono_celular
 * @property string $fecha_nacimiento
 * @property string $correo_electronico
 * @property string $lugar_nacimiento
 * @property string $profesion_paciente
 * @property string $antecedente_paciente
 * @property string $seguro_id
 * @property string $estado_civil_id
 * @property string $ult_mod
 * @property string $usuario_id_mod
 * @property string $nacionalidad_id
 * @property string $sexo
 *
 * The followings are the available model relations:
 * @property EstadoCivil $estadoCivil
 * @property Nacionalidad $nacionalidad
 * @property Seguro $seguro
 */
class Paciente extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paciente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_paciente, apellido_paciente, cedula_paciente, direccion_paciente, fecha_nacimiento, lugar_nacimiento, seguro_id, estado_civil_id, nacionalidad_id, sexo', 'required'),
			array('nombre_paciente, apellido_paciente', 'length', 'max'=>1000),
			array('cedula_paciente', 'CRegularExpressionValidator', 'pattern' => '/^[0-9]+$/', 'message' => 'Cédula no válida'),
			array('cedula_paciente', 'unique', 'message'=>'Ya ésta cédula está registrada.'),
			array('direccion_paciente', 'length', 'max'=>150),
			array('telefono_habitacion, telefono_celular', 'length', 'max'=>12),
			array('correo_electronico, lugar_nacimiento, profesion_paciente, antecedente_paciente', 'length', 'max'=>200),
			array('correo_electronico', 'email'),
			array('seguro_id, estado_civil_id, usuario_id_mod, nacionalidad_id', 'length', 'max'=>10),
			array('sexo', 'length', 'max'=>1),
			array('fecha_nacimiento','ValidarFechaNacimiento', 'on'=>array('insert', 'update')),
			array('cedula_paciente', 'ValidarCedula_VE', 'on'=>array('insert', 'update')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nombre_paciente, apellido_paciente, cedula_paciente, telefono_celular, fecha_nacimiento, correo_electronico, lugar_nacimiento, sexo', 'safe', 'on'=>'search'),
		);
	}

	/*
	* Valida que la fecha de nacimiento no sea mayor que el día actual.
	*/
	public function ValidarFechaNacimiento($attribute){

		$today = new DateTime();
		$birth = new DateTime($this->fecha_nacimiento);	

		if( ($birth > $today) ){

			$this->addError($attribute,"La fecha de nacimiento no puede ser mayor a la fecha actual.");
		}			
		elseif( ($birth->format('%d') == $today->format('%d')) && ($birth->format('%m') == $today->format('%m')) && ($birth->format('%Y') == $today->format('%Y')) ){

			$this->addError($attribute,"La fecha de nacimiento no puede ser igual a la fecha actual.");
		}
	}

	/*
	* Valida la longitud de la cédula dependiendo de si es V o E.
	*/
	public function ValidarCedula_VE($attribute){

		if($this->nacionalidad_id == 1){

			if(strlen($this->cedula_paciente) < 6 || strlen($this->cedula_paciente) > 8)
				$this->addError($attribute,"Cédula no válida. Mínimo 6 y máximo 8 caracteres para cédulas venezolanas.");
		}			
		elseif($this->nacionalidad_id == 2){
			
			if(strlen($this->cedula_paciente) < 6 || strlen($this->cedula_paciente) > 15)
				$this->addError($attribute,"Cédula no válida. Mínimo 6 y máximo 8 caracteres para cédulas extranjeras.");
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
			'estadoCivil' => array(self::BELONGS_TO, 'EstadoCivil', 'estado_civil_id'),
			'nacionalidad' => array(self::BELONGS_TO, 'Nacionalidad', 'nacionalidad_id'),
			'seguro' => array(self::BELONGS_TO, 'Seguro', 'seguro_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'paciente_id' => 'Paciente',
			'nombre_paciente' => 'Nombre',
			'apellido_paciente' => 'Apellido',
			'cedula_paciente' => 'Número de Cédula',
			'direccion_paciente' => 'Dirección de Habitación',
			'telefono_habitacion' => 'Teléfono de Habitación',
			'telefono_celular' => 'Telefono Celular',
			'fecha_nacimiento' => 'Fecha de Nacimiento',
			'correo_electronico' => 'Correo Electrónico',
			'lugar_nacimiento' => 'Lugar de Nacimiento',
			'profesion_paciente' => 'Profesión',
			'antecedente_paciente' => 'Antecedentes del Paciente',
			'seguro_id' => 'Compañía de Seguro Médico',
			'estado_civil_id' => 'Estado Civil',
			'ult_mod' => 'Ult Mod',
			'usuario_id_mod' => 'Usuario Id Mod',
			'nacionalidad_id' => 'Nacionalidad',
			'sexo' => 'Sexo',
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

		$criteria->compare('paciente_id',$this->paciente_id,true);
		$criteria->compare('nombre_paciente',$this->nombre_paciente,true);
		$criteria->compare('apellido_paciente',$this->apellido_paciente,true);
		$criteria->compare('cedula_paciente',$this->cedula_paciente,true);
		$criteria->compare('direccion_paciente',$this->direccion_paciente,true);
		$criteria->compare('telefono_habitacion',$this->telefono_habitacion,true);
		$criteria->compare('telefono_celular',$this->telefono_celular,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('correo_electronico',$this->correo_electronico,true);
		$criteria->compare('lugar_nacimiento',$this->lugar_nacimiento,true);
		$criteria->compare('profesion_paciente',$this->profesion_paciente,true);
		$criteria->compare('antecedente_paciente',$this->antecedente_paciente,true);
		$criteria->compare('seguro_id',$this->seguro_id,true);
		$criteria->compare('estado_civil_id',$this->estado_civil_id,true);
		$criteria->compare('ult_mod',$this->ult_mod,true);
		$criteria->compare('usuario_id_mod',$this->usuario_id_mod,true);
		$criteria->compare('nacionalidad_id',$this->nacionalidad_id,true);
		$criteria->compare('sexo',$this->sexo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paciente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
