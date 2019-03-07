<?php

/**
 * This is the model class for table "farmaco".
 *
 * The followings are the available columns in table 'farmaco':
 * @property string $farmaco_id
 * @property string $descripcion_farmaco
 */
class Farmaco extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'farmaco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion_farmaco', 'required'),
			array('descripcion_farmaco', 'unique'),
			array('descripcion_farmaco', 'length', 'max'=>100),
			array('descripcion_farmaco', 'CRegularExpressionValidator', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Descripción no válida. Sólo se permiten caracteres alfabeticos.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('farmaco_id, descripcion_farmaco', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'farmaco_id' => 'Fármaco',
			'descripcion_farmaco' => 'Descripción Fármaco',
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

		$criteria->compare('farmaco_id',$this->farmaco_id,true);
		$criteria->compare('descripcion_farmaco',$this->descripcion_farmaco,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Farmaco the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
