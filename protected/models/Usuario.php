<?php
/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $usuario_id
 * @property string $login_usuario
 * @property string $clave_usuario
 * @property string $cedula_usuario
 * @property string $nombre_usuario
 * @property string $apellido_usuario
 * @property string $tipo_usuario_id
 * @property integer $activo
 * @property string $ultimo_acceso
 *
 * The followings are the available model relations:
 * @property TipoUsuario $tipoUsuario
 */
class Usuario extends CActiveRecord
{
	private $_descripcionUsuario = null;
	public $clave_usuario_repeat = null;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('login_usuario, cedula_usuario, nombre_usuario, apellido_usuario, tipo_usuario_id', 'required', 'on'=>array('insert','update')),
			array('clave_usuario, clave_usuario_repeat', 'required', 'on'=>array('insert')),
			array('login_usuario','unique', 'message' => 'Este login de usuario ya existe'),
			array('activo, tipo_usuario_id, reset_clave', 'numerical', 'integerOnly'=>true),
			array('login_usuario', 'length', 'max'=>12, 'min'=>3),	
			array('login_usuario', 'CRegularExpressionValidator', 'pattern' => '/^[a-zA-Z0-9]+$/', 'message' => 'Login no válido. Sólo se permiten caracteres alfanumericos.'),
			array('clave_usuario, clave_usuario_repeat', 'length', 'min'=>4),
			array('cedula_usuario', 'length', 'max'=>8, 'min'=>6),
			array('cedula_usuario', 'CRegularExpressionValidator', 'pattern' => '/^[0-9]+$/', 'message' => 'Cédula no válida'),
			array('nombre_usuario, apellido_usuario', 'length', 'max'=>200),
			array('clave_usuario','Comparar_Claves','on'=>array('insert')),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('login_usuario, cedula_usuario, nombre_usuario, apellido_usuario, activo, descripcionUsuario', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */

	public function Comparar_Claves($attribute)
	{
		if ($this->clave_usuario != sha1($this->clave_usuario_repeat)){
			$this->addError($attribute,"Las claves deben coincidir.");
		}
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tipoUsuario' => array(self::BELONGS_TO, 'TipoUsuario', 'tipo_usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'usuario_id' => 'Usuario',
			'login_usuario' => 'Login',
			'clave_usuario' => 'Clave',
			'cedula_usuario' => 'Cédula',
			'nombre_usuario' => 'Nombre',
			'apellido_usuario' => 'Apellido',
			'tipo_usuario_id' => 'Tipo Usuario',
			'descripcionUsuario' => 'Tipo Usuario',
			'clave_usuario_repeat' => 'Confirmar Clave',
			'activo' => 'Activo',
			'ultimo_acceso' => 'Último Acceso',
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
		$criteria->with = "tipoUsuario";

		$criteria->compare('t.login_usuario', $this->login_usuario, true);
		$criteria->compare('t.cedula_usuario', $this->cedula_usuario, true);
		$criteria->compare('t.nombre_usuario', $this->nombre_usuario, true);
		$criteria->compare('t.apellido_usuario', $this->apellido_usuario, true);
		$criteria->compare('t.activo', $this->get_intActivo($this->activo), true);
		$criteria->compare('tipoUsuario.descripcion_tipo_usuario', $this->descripcionUsuario, true);

		$sort = new CSort();
		$sort->attributes = array(
		    'defaultOrder'=>'t.login_usuario DESC',
		    'login_usuario'=>array(
		        'asc'=>'t.login_usuario',
		        'desc'=>'t.login_usuario desc',
		    ),
		    'cedula_usuario'=>array(
		        'asc'=>'t.cedula_usuario',
		        'desc'=>'t.cedula_usuario desc',
		    ),
		    'nombre_usuario'=>array(
		        'asc'=>'t.nombre_usuario',
		        'desc'=>'t.nombre_usuario desc',
		    ),
		    'apellido_usuario'=>array(
		        'asc'=>'t.apellido_usuario',
		        'desc'=>'t.apellido_usuario desc',
		    ),		    
		    'descripcionUsuario'=>array(
		        'asc'=>'tipoUsuario.descripcion_tipo_usuario',
		        'desc'=>'tipoUsuario.descripcion_tipo_usuario desc',
		    ),
		    'activo'=>array(
		        'asc'=>'t.activo',
		        'desc'=>'t.activo desc',
		    ),
		);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getdescripcionUsuario()
	{
	    if ($this->_descripcionUsuario === null && $this->tipoUsuario !== null)
	    {
	        $this->_descripcionUsuario = $this->tipoUsuario->descripcion_tipo_usuario;
	    }

	    return $this->_descripcionUsuario;
	}

	public function setdescripcionUsuario($value)
	{
	    $this->_descripcionUsuario = $value;
	}	

	public function get_strActivo(){
		if($this->activo == 1)
			return "SI";
		elseif($this->activo == 0)
			return "NO";
	}

	public function get_intActivo($value){
		if( (strtolower($value) == "si") or (strtolower($value) == "s") or (strtolower($value) == "i") )
			return 1;
		elseif( (strtolower($value) == "no") or (strtolower($value) == "n") or (strtolower($value) == "o") )
			return 0;
		elseif($value == "1")
			return " ";
		elseif($value == "0")
			return " ";
		else
			return $value;		
	}	

	public function get_strUltimoAcceso(){

		$strUltimoAcceso = "";

		$strFecha = substr($this->ultimo_acceso, 0, 10);
		$strFecha = Funciones::invertirFecha($strFecha);

		$strHora = substr($this->ultimo_acceso, 11, 8);		

		$strUltimoAcceso = $strFecha.' '.$strHora;

		return $strUltimoAcceso;
	}

	public function getNombreCompleto(){

		return $this->nombre_usuario.' '.$this->apellido_usuario;
	}

}