<?php

/**
 * This is the model class for table "consulta_patologia".
 *
 * The followings are the available columns in table 'consulta_patologia':
 * @property string $consulta_patologia_id
 * @property string $consulta_id
 * @property string $patologia_id
 *
 * The followings are the available model relations:
 * @property Patologia $patologia
 * @property Consulta $consulta
 */
class ConsultaPatologia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consulta_patologia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('consulta_id, patologia_id', 'required'),
			array('consulta_id, patologia_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('consulta_patologia_id, consulta_id, patologia_id', 'safe', 'on'=>'search'),
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
			'patologia' => array(self::BELONGS_TO, 'Patologia', 'patologia_id'),
			'consulta' => array(self::BELONGS_TO, 'Consulta', 'consulta_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'consulta_patologia_id' => 'Consulta Patologia',
			'consulta_id' => 'Consulta',
			'patologia_id' => 'Patologia',
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

		$criteria->compare('consulta_patologia_id',$this->consulta_patologia_id,true);
		$criteria->compare('consulta_id',$this->consulta_id,true);
		$criteria->compare('patologia_id',$this->patologia_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConsultaPatologia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
