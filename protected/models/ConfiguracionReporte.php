<?php

/**
 * This is the model class for table "configuracion_reporte".
 *
 * The followings are the available columns in table 'configuracion_reporte':
 * @property integer $configuracion_reporte_id
 * @property string $ubicacion_logo
 * @property string $titulo_reporte
 * @property string $subtitulo_1
 * @property string $subtitulo_2
 * @property string $subtitulo_3
 * @property string $subtitulo_4
 */
class ConfiguracionReporte extends CActiveRecord
{

	public $_imagenLogo;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'configuracion_reporte';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('ubicacion_logo, titulo_reporte', 'required'),
			array('_imagenLogo, ubicacion_logo', 'required'),
			array('ubicacion_logo', 'length', 'max'=>200),
			array('titulo_reporte, subtitulo_1, subtitulo_2, subtitulo_3, subtitulo_4', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('configuracion_reporte_id, ubicacion_logo, titulo_reporte, subtitulo_1, subtitulo_2, subtitulo_3, subtitulo_4', 'safe', 'on'=>'search'),
			array('_imagenLogo','file','types'=>'jpg, jpeg, png'),
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
			'configuracion_reporte_id' => 'Configuracion Reporte',
			'ubicacion_logo' => 'Ubicacion Logo',
			'titulo_reporte' => 'Título Reporte',
			'subtitulo_1' => 'Subtítulo 1',
			'subtitulo_2' => 'Subtítulo 2',
			'subtitulo_3' => 'Subtítulo 3',
			'subtitulo_4' => 'Subtítulo 4',
			'imagenLogo' => 'Imagen Logo',	
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

		$criteria->compare('configuracion_reporte_id',$this->configuracion_reporte_id);
		$criteria->compare('ubicacion_logo',$this->ubicacion_logo,true);
		$criteria->compare('titulo_reporte',$this->titulo_reporte,true);
		$criteria->compare('subtitulo_1',$this->subtitulo_1,true);
		$criteria->compare('subtitulo_2',$this->subtitulo_2,true);
		$criteria->compare('subtitulo_3',$this->subtitulo_3,true);
		$criteria->compare('subtitulo_4',$this->subtitulo_4,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConfiguracionReporte the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
