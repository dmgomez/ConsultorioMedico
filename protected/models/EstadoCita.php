<?php

/**
 * This is the model class for table "estado_cita".
 *
 * The followings are the available columns in table 'estado_cita':
 * @property string $estado_cita_id
 * @property string $descripcion_estado_cita
 *
 * The followings are the available model relations:
 * @property Cita[] $citas
 */
class EstadoCita extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'estado_cita';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('estado_cita_id, descripcion_estado_cita', 'required'),
			array('estado_cita_id', 'length', 'max'=>10),
			array('descripcion_estado_cita', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('estado_cita_id, descripcion_estado_cita', 'safe', 'on'=>'search'),
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
			'citas' => array(self::HAS_MANY, 'Cita', 'estado_cita_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'estado_cita_id' => 'Estado Cita',
			'descripcion_estado_cita' => 'Estado Cita',
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

		$criteria->compare('estado_cita_id',$this->estado_cita_id,true);
		$criteria->compare('descripcion_estado_cita',$this->descripcion_estado_cita,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstadoCita the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
