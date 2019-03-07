<?php

/**
 * This is the model class for table "tipo_usuario".
 *
 * The followings are the available columns in table 'tipo_usuario':
 * @property string $tipo_usuario_id
 * @property string $descripcion_tipo_usuario
 * @property integer $db_activo
 *
 * The followings are the available model relations:
 * @property Usuario[] $usuarios
 */
class TipoUsuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion_tipo_usuario', 'required'),
			array('db_activo', 'numerical', 'integerOnly'=>true),
			array('descripcion_tipo_usuario', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tipo_usuario_id, descripcion_tipo_usuario, db_activo', 'safe', 'on'=>'search'),
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
			'usuarios' => array(self::HAS_MANY, 'Usuario', 'tipo_usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tipo_usuario_id' => 'Tipo Usuario',
			'descripcion_tipo_usuario' => 'Descripcion Tipo Usuario',
			'db_activo' => 'Db Activo',
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

		$criteria->compare('tipo_usuario_id',$this->tipo_usuario_id,true);
		$criteria->compare('descripcion_tipo_usuario',$this->descripcion_tipo_usuario,true);
		$criteria->compare('db_activo',$this->db_activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoUsuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
