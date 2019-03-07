<?php

/**
 * This is the model class for table "presupuesto".
 *
 * The followings are the available columns in table 'presupuesto':
 * @property integer $presupuesto_id
 * @property string $paciente_id
 * @property string $fecha_presupuesto
 * @property string $condicion
 * @property string $diagnostico
 * @property string $intervencion_tramiento
 * @property string $dias_hospitalizacion
 * @property string $rutina_laboratorio
 * @property string $tele_torax
 * @property string $biopsia
 * @property string $cardiovascular
 * @property string $otros_examenes
 * @property double $medico_tratante
 * @property double $cirujano_principal
 * @property double $ayudante1
 * @property double $ayudante2
 * @property double $anestesiologo
 * @property double $tecnico
 * @property double $urovideo
 * @property double $instrumental
 * @property double $interconsulta
 * @property double $total_presupuesto
 * @property string $observaciones
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 */
class Presupuesto extends CActiveRecord
{
	private $_cedulaPaciente;
	private $_nombrePaciente;
	private $_edadPaciente;
	private $_rutinaLaboratorio;
	private $_teleTorax;
	private $_biopsia;
	private $_cardiovascular;
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'presupuesto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id, cedulaPaciente, nombrePaciente, fecha_presupuesto, diagnostico, intervencion_tramiento', 'required'),
			array('dias_hospitalizacion, medico_tratante, cirujano_principal, ayudante1, ayudante2, anestesiologo, tecnico, urovideo, instrumental, interconsulta, total_presupuesto', 'numerical'),
			array('paciente_id', 'length', 'max'=>11),
			array('condicion, diagnostico, intervencion_tramiento, otros_examenes, observaciones', 'length', 'max'=>1000),
			array('dias_hospitalizacion', 'length', 'max'=>2),
			array('rutina_laboratorio, tele_torax, biopsia, cardiovascular', 'length', 'max'=>1),
			array('fecha_presupuesto','ValidarFecha', 'on'=>array('insert')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('presupuesto_id, paciente_id, cedulaPaciente, nombrePaciente, fecha_presupuesto, condicion, diagnostico, intervencion_tramiento, dias_hospitalizacion, rutina_laboratorio, tele_torax, biopsia, cardiovascular, otros_examenes, medico_tratante, cirujano_principal, ayudante1, ayudante2, anestesiologo, tecnico, urovideo, instrumental, interconsulta, total_presupuesto, observaciones', 'safe', 'on'=>'search'),
		);
	}

	/*
	* Valida que la fecha de la cita no sea menor a la actual
	*/
	public function ValidarFecha($attribute){

		$today = new DateTime();
		$fecha = new DateTime($this->fecha_presupuesto);

		if( ($fecha < $today) && ($fecha->format('Y-m-d') <> $today->format('Y-m-d')) ){

			$this->addError($attribute,"La fecha del presupusto no puede ser menor a la fecha actual.");
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
			'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'presupuesto_id' => 'Presupuesto',
			'paciente_id' => 'Paciente',
			'cedulaPaciente' => 'C&eacute;dula Paciente',
			'_nombrePaciente' => 'Paciente',
			'_edadPaciente' => 'Edad',
			'fecha_presupuesto' => 'Fecha Presupuesto',
			'condicion' => 'Condici&oacute;n',
			'diagnostico' => 'Diagn&oacute;stico',
			'intervencion_tramiento' => 'Intervenci&oacute;n o Tratamiento',
			'dias_hospitalizacion' => 'D&iacute;as Hospitalizaci&oacute;n',
			'_rutinaLaboratorio' => 'Rutina Laboratorio',
			'_teleTorax' => 'Tele T&oacute;rax',
			'_biopsia' => 'Biopsia',
			'_cardiovascular' => 'Cardiovascular',
			'otros_examenes' => 'Otros Ex&aacute;menes',
			'medico_tratante' => 'M&eacute;dico Tratante',
			'cirujano_principal' => 'Cirujano Principal',
			'ayudante1' => 'Ayudante1',
			'ayudante2' => 'Ayudante2',
			'anestesiologo' => 'Anestesi&oacute;logo',
			'tecnico' => 'T&eacute;cnico',
			'urovideo' => 'Urovideo',
			'instrumental' => 'Instrumental',
			'interconsulta' => 'Interconsulta',
			'total_presupuesto' => 'Total Presupuesto',
			'observaciones' => 'Observaciones',
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
		$criteria->with = array("paciente");

		$criteria->compare('presupuesto_id',$this->presupuesto_id);
		$criteria->compare('paciente_id',$this->paciente_id,true);
		$criteria->compare('paciente.cedula_paciente',$this->_cedulaPaciente,true);
		$criteria->compare('paciente.nombre_paciente',$this->_nombrePaciente,true);
		$criteria->compare('paciente.apellido_paciente',$this->_nombrePaciente,true, 'OR');
		$criteria->compare('concat(paciente.nombre_paciente, " ", paciente.apellido_paciente)',$this->_nombrePaciente,true, 'OR');
		$criteria->compare('fecha_presupuesto',$this->fecha_presupuesto,true);
		$criteria->compare('condicion',$this->condicion,true);
		$criteria->compare('diagnostico',$this->diagnostico,true);
		$criteria->compare('intervencion_tramiento',$this->intervencion_tramiento,true);
		$criteria->compare('dias_hospitalizacion',$this->dias_hospitalizacion,true);
		$criteria->compare('rutina_laboratorio',$this->rutina_laboratorio,true);
		$criteria->compare('tele_torax',$this->tele_torax,true);
		$criteria->compare('biopsia',$this->biopsia,true);
		$criteria->compare('cardiovascular',$this->cardiovascular,true);
		$criteria->compare('otros_examenes',$this->otros_examenes,true);
		$criteria->compare('medico_tratante',$this->medico_tratante);
		$criteria->compare('cirujano_principal',$this->cirujano_principal);
		$criteria->compare('ayudante1',$this->ayudante1);
		$criteria->compare('ayudante2',$this->ayudante2);
		$criteria->compare('anestesiologo',$this->anestesiologo);
		$criteria->compare('tecnico',$this->tecnico);
		$criteria->compare('urovideo',$this->urovideo);
		$criteria->compare('instrumental',$this->instrumental);
		$criteria->compare('interconsulta',$this->interconsulta);
		$criteria->compare('total_presupuesto',$this->total_presupuesto);
		$criteria->compare('observaciones',$this->observaciones,true);





		$sort = new CSort();
		$sort->attributes = array(

		    'paciente_id'=>array(
		        'asc'=>'t.paciente_id',
		        'desc'=>'t.paciente_id desc',
		    ),
		    'cedulaPaciente'=>array(
		        'asc'=>'paciente.cedula_paciente',
		        'desc'=>'paciente.cedula_paciente desc',
		    ),
		    'nombrePaciente'=>array(
		        'asc'=>'paciente.nombre_paciente',
		        'desc'=>'paciente.nombre_paciente desc',
		    ),
		    'fecha_presupuesto'=>array(
		        'asc'=>'t.fecha_presupuesto',
		        'desc'=>'t.fecha_presupuesto desc',
		    ),
		   	'condicion'=>array(
		        'asc'=>'t.condicion',
		        'desc'=>'t.condicion desc',
		    ),
		    'diagnostico'=>array(
		        'asc'=>'t.diagnostico',
		        'desc'=>'t.diagnostico desc',
		    ),
		    'intervencion_tramiento'=>array(
		        'asc'=>'t.intervencion_tramiento',
		        'desc'=>'t.intervencion_tramiento desc',
		    ),
		);
		$sort->defaultOrder = 't.fecha_presupuesto DESC, t.paciente_id ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));





		/*return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/

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

	/*SET redefinido para acceder a los campos virtuales agregados*/
	public function setedadPaciente($value){

		$this->_edadPaciente = $value;
	}

	public function getrutinaLaboratorio(){

	    if ($this->rutina_laboratorio == 1) {

	        $this->_rutinaLaboratorio = 'SI';
	    }
	    else
	    {
	    	$this->_rutinaLaboratorio = 'NO';
	    }

	    return $this->_rutinaLaboratorio;
	}

	public function getteleTorax(){

	    if ($this->tele_torax == 1) {

	        $this->_teleTorax = 'SI';
	    }
	    else
	    {
	    	$this->_teleTorax = 'NO';
	    }

	    return $this->_teleTorax;
	}

	public function getbiopsiaP(){

	    if ($this->biopsia == 1) {

	        $this->_biopsia = 'SI';
	    }
	    else
	    {
	    	$this->_biopsia = 'NO';
	    }

	    return $this->_biopsia;
	}

	public function getcardiovascularP(){

	    if ($this->cardiovascular == 1) {

	        $this->_cardiovascular = 'SI';
	    }
	    else
	    {
	    	$this->_cardiovascular = 'NO';
	    }

	    return $this->_cardiovascular;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Presupuesto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
