<?php

/**
 * This is the model class for table "historia_medica_consulta".
 *
 * The followings are the available columns in table 'historia_medica_consulta':
 * @property integer $id
 * @property string $consulta_id
 * @property string $historia_medica_id
 * @property integer $parent_id
 * @property string $title
 * @property integer $position
 * @property string $tooltip
 * @property string $url
 * @property string $icon
 * @property integer $visible
 * @property string $task
 *
 * The followings are the available model relations:
 * @property Consulta $consulta
 * @property HistoriaMedica $historiaMedica
 */
class HistoriaMedicaConsulta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'historia_medica_consulta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('consulta_id, historia_medica_id, title, position, url, visible', 'required'),
			array('parent_id, position, visible', 'numerical', 'integerOnly'=>true),
			array('consulta_id, historia_medica_id', 'length', 'max'=>10),
			array('title, tooltip, icon, task', 'length', 'max'=>200),
			array('url', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, consulta_id, historia_medica_id, parent_id, title, position, tooltip, url, icon, visible, task', 'safe', 'on'=>'search'),
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
			'consulta' => array(self::BELONGS_TO, 'Consulta', 'consulta_id'),
			'historiaMedica' => array(self::BELONGS_TO, 'HistoriaMedica', 'historia_medica_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'consulta_id' => 'Consulta',
			'historia_medica_id' => 'Historia Medica',
			'parent_id' => 'Parent',
			'title' => 'Title',
			'position' => 'Position',
			'tooltip' => 'Tooltip',
			'url' => 'Url',
			'icon' => 'Icon',
			'visible' => 'Visible',
			'task' => 'Task',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('consulta_id',$this->consulta_id,true);
		$criteria->compare('historia_medica_id',$this->historia_medica_id,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('tooltip',$this->tooltip,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('task',$this->task,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HistoriaMedicaConsulta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
