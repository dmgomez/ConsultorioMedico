<?php

/**
 * This is the model class for table "consulta".
 *
 * The followings are the available columns in table 'consulta':
 * @property string $consulta_id
 * @property string $paciente_id
 * @property string $fecha_consulta
 * @property string $motivo_consulta
 * @property string $diagnostico
 * @property string $laboratorio
 * @property string $biopsia
 * @property string $radio_imagenes
 * @property string $examen_fisico
 * @property string $observaciones
 * @property string $tratamiento
 * @property string $recomendacion
 * @property string $usuario_id
 * @property string $usuario_id_mod
 * @property string $ult_mod
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property Usuario $usuario
 * @property Usuario $usuarioIdMod
 * @property ConsultaPatologia[] $consultaPatologias
 */
class Consulta extends CActiveRecord
{
	private $_nombrePaciente;
	private $_antecedentePaciente;
	private $_diagnosticoId;
	private $_diagnostico;

	//public $_descripcionPatologia;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consulta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id, nombrePaciente, antecedentePaciente, fecha_consulta, motivo_consulta, diagnosticoId, usuario_id, ult_mod', 'required'),
			array('paciente_id, usuario_id, usuario_id_mod', 'length', 'max'=>10),
			array('motivo_consulta, laboratorio, biopsia, radio_imagenes, examen_fisico, observaciones, tratamiento, recomendacion', 'length', 'max'=>1000),
			/*array('descripcion_patologia', 'unique'),
			array('descripcion_patologia', 'length', 'max'=>1000),
			array('descripcion_patologia', 'CRegularExpressionValidator', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Descripción no válida. Sólo se permiten caracteres alfabeticos.'),*/
			//array('diagnostico', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('consulta_id, paciente_id, nombrePaciente, fecha_consulta, motivo_consulta, diagnostico, laboratorio, biopsia, radio_imagenes, examen_fisico, observaciones, tratamiento, recomendacion, usuario_id, usuario_id_mod, ult_mod', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
			'usuarioIdMod' => array(self::BELONGS_TO, 'Usuario', 'usuario_id_mod'),
			'consultaPatologias' => array(self::HAS_MANY, 'ConsultaPatologia', 'consulta_id'),
			'patologia'=>array(self::MANY_MANY, 'Patologia', 'consulta_patologia(consulta_id, patologia_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'consulta_id' => 'Consulta',
			'paciente_id' => 'Paciente',
			'diagnosticoId'=>'Diagnostico ID',
			'nombrePaciente' => 'Nombre Paciente',
			'fecha_consulta' => 'Fecha Consulta',
			'motivo_consulta' => 'Motivo Consulta',
			'_diagnostico' => 'Diagnóstico',
			'laboratorio' => 'Laboratorio',
			'biopsia' => 'Biopsia',
			'radio_imagenes' => 'Radio-Imágenes',
			'examen_fisico' => 'Exámen Físico',
			'observaciones' => 'Observaciones',
			'tratamiento' => 'Tratamiento',
			'recomendacion' => 'Recomendación',
			'usuario_id' => 'Usuario',
			'usuario_id_mod' => 'Usuario Id Mod',
			'ult_mod' => 'Ult Mod',
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

		$criteria->compare('consulta_id',$this->consulta_id,true);
		$criteria->compare('paciente_id',$this->paciente_id,true);
		$criteria->compare('paciente.nombre_paciente',$this->_nombrePaciente,true);
		$criteria->compare('paciente.apellido_paciente',$this->_nombrePaciente,true, 'OR');
		$criteria->compare('concat(paciente.nombre_paciente, " ", paciente.apellido_paciente)',$this->_nombrePaciente,true, 'OR');
		$criteria->compare('fecha_consulta',$this->fecha_consulta,true);
		$criteria->compare('motivo_consulta',$this->motivo_consulta,true);
		$criteria->compare('diagnostico',$this->_diagnostico,true);
		$criteria->compare('laboratorio',$this->laboratorio,true);
		$criteria->compare('biopsia',$this->biopsia,true);
		$criteria->compare('radio_imagenes',$this->radio_imagenes,true);
		$criteria->compare('examen_fisico',$this->examen_fisico,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('tratamiento',$this->tratamiento,true);
		$criteria->compare('recomendacion',$this->recomendacion,true);
		$criteria->compare('usuario_id',$this->usuario_id,true);
		$criteria->compare('usuario_id_mod',$this->usuario_id_mod,true);
		$criteria->compare('ult_mod',$this->ult_mod,true);

		$sort = new CSort();
		$sort->attributes = array(

			'paciente_id'=>array(
		        'asc'=>'t.paciente_id',
		        'desc'=>'t.paciente_id desc',
		    ),
		    'nombrePaciente'=>array(
		        'asc'=>'paciente.nombre_paciente',
		        'desc'=>'paciente.nombre_paciente desc',
		    ),
		    'fecha_consulta'=>array(
		        'asc'=>'t.fecha_consulta',
		        'desc'=>'t.fecha_consulta desc',
		    ),
		   	'motivo_consulta'=>array(
		        'asc'=>'t.motivo_consulta',
		        'desc'=>'t.motivo_consulta desc',
		    ),
		    
		);
		$sort->defaultOrder = 't.fecha_consulta DESC, t.paciente_id ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}

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

	public function getantecedentePaciente(){

	    if ($this->_antecedentePaciente === null && $this->paciente !== null){

	        $this->_antecedentePaciente = $this->paciente->antecedente_paciente;
	    }

	    return $this->_antecedentePaciente;
	}

	/*SET redefinido para acceder a los campos virtuales agregados*/
	public function setantecedentePaciente($value){

		$this->_antecedentePaciente = $value;
	}

	public function get_diagnostico(){

	    if ($this->_diagnostico === null)
		{	
		    foreach ($this->patologia as $value) 
			{
				
				$image = CHtml::image(Yii::app()->theme->baseUrl.'/images/Trash.png', 'Eliminar',  array("class"=>"borra_patologia", "value"=>$value->patologia_id, "id"=>$value->patologia_id));
				$this->_diagnostico = $this->_diagnostico.'<label id="'.$value->patologia_id.'">'.$value->descripcion_patologia. ' '. $image.'</label>';

			}
		}

		/*if ($this->_diagnosticoId !== null)
		{
			$diag=explode(',', $this->_diagnosticoId);
		    foreach ($diag as $value) 
			{
				$agregada = Patologia::model()->findByAttributes( array('patologia_id'=>$value) );
			
				$this->_diagnostico = $this->_diagnostico.' '. $agregada->descripcion_patologia;
			}
		}*/

	    return $this->_diagnostico;
	}

	public function getdiagnosticoId(){

	    if ($this->_diagnosticoId === null)
		{
		    foreach ($this->patologia as $value) 
			{
				$this->_diagnosticoId = $this->_diagnosticoId.''.$value->patologia_id.',';

			}
			$this->_diagnosticoId = substr($this->_diagnosticoId, 0, -1);
		}

		return $this->_diagnosticoId;
	}

	public function setdiagnosticoId($value){

		$this->_diagnosticoId = $value;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Consulta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}


