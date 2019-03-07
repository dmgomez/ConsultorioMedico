<?php

/**
 * This is the model class for table "seguro".
 *
 * The followings are the available columns in table 'seguro':
 * @property string $seguro_id
 * @property string $nombre_seguro
 *
 * The followings are the available model relations:
 * @property Paciente[] $pacientes
 */
class Seguro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seguro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_seguro', 'required'),
			array('nombre_seguro', 'unique'),
			array('nombre_seguro', 'length', 'max'=>100),
			array('nombre_seguro', 'CRegularExpressionValidator', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Descripción no válida. Sólo se permiten caracteres alfabeticos.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nombre_seguro', 'safe', 'on'=>'search'),
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
			'pacientes' => array(self::HAS_MANY, 'Paciente', 'seguro_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'seguro_id' => 'Seguro',
			'nombre_seguro' => 'Descripción del Seguro',
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

		$criteria->compare('seguro_id',$this->seguro_id,true);
		$criteria->compare('nombre_seguro',$this->nombre_seguro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Seguro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
