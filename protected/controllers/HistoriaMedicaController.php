<?php

class HistoriaMedicaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'BuscarPacientePorID', 'BuscarPacientePorCedula'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout = 'double';
		$model=new HistoriaMedica;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HistoriaMedica']))
		{
			$model->attributes=$_POST['HistoriaMedica'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->historia_medica_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout = 'double';
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HistoriaMedica']))
		{
			$model->attributes=$_POST['HistoriaMedica'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->historia_medica_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionBuscarPacientePorCedula(){

		$result = array('success' => false);
		
		$cedula = $_POST['cedula'];

		$model = Paciente::model()->findByAttributes( array('cedula_paciente'=>$cedula) );
		
		if($model){

			$anyoN = date("Y", strtotime($model->fecha_nacimiento));
	        $mesN = date("m", strtotime($model->fecha_nacimiento)); 
	        $diaN = date("d", strtotime($model->fecha_nacimiento)); 

	        $anyoA = date("Y");
	        $mesA = date("m");
	        $diaA = date("d");

	        $edad = $anyoA - $anyoN;

	        if($mesA < $mesN || ( ($mesA==$mesN) && ($diaN >= $diaA) ) )
	        {
	        	$edad -= 1;
	        }

	        $edoCivil = EstadoCivil::model()->findByPk($model->estado_civil_id);

	        $estadoCivil ='';

	        if($edoCivil)
	        {
	        	$estadoCivil = $edoCivil->descripcion_estado_civil;
	        }

	        $seguroMed = Seguro::model()->findByPk($model->seguro_id);

	        $seguroMedico ='';

	        if($seguroMed)
	        {
	        	$seguroMedico = $seguroMed->nombre_seguro;
	        }

			//$result = array('success' => true, 'cedula' => $model->cedula_paciente, 'paciente' => $model->nombre_paciente.' '.$model->apellido_paciente, 'id' => $model->paciente_id, 'edad' => $edad);
			$result = array('success' => true, 'cedula' => $model->cedula_paciente, 'paciente' => $model->nombre_paciente.' '.$model->apellido_paciente, 'id' => $model->paciente_id, 'edad' => $edad, 
				'fechaNacimiento' => $model->fecha_nacimiento, 'lugarNacimiento' => $model->lugar_nacimiento, 'estadoCivil' => $estadoCivil, 'direccion' => $model->direccion_paciente, 'tlfHab' => $model->telefono_habitacion, 
				'tlfCel' => $model->telefono_celular, 'seguro' => $seguroMedico, 'profesion' => $model->profesion_paciente);
		}		

		echo CJSON::encode($result);
	}

	public function actionBuscarPacientePorID($ID){

		$result = array('success' => false);			

		$model = Paciente::model()->findByAttributes( array('paciente_id' => $ID) );
		
		if($model)
		{
			$anyoN = date("Y", strtotime($model->fecha_nacimiento));
	        $mesN = date("m", strtotime($model->fecha_nacimiento)); 
	        $diaN = date("d", strtotime($model->fecha_nacimiento)); 

	        $anyoA = date("Y");
	        $mesA = date("m");
	        $diaA = date("d");

	        $edad = $anyoA - $anyoN;

	        if($mesA < $mesN || ( ($mesA==$mesN) && ($diaN >= $diaA) ) )
	        {
	        	$edad -= 1;
	        }

	        $edoCivil = EstadoCivil::model()->findByPk($model->estado_civil_id);

	        $estadoCivil ='';

	        if($edoCivil)
	        {
	        	$estadoCivil = $edoCivil->descripcion_estado_civil;
	        }

	        $seguroMed = Seguro::model()->findByPk($model->seguro_id);

	        $seguroMedico ='';

	        if($seguroMed)
	        {
	        	$seguroMedico = $seguroMed->nombre_seguro;
	        }

			$result = array('success' => true, 'cedula' => $model->cedula_paciente, 'paciente' => $model->nombre_paciente.' '.$model->apellido_paciente, 'id' => $model->paciente_id, 'edad' => $edad, 
				'fechaNacimiento' => $model->fecha_nacimiento, 'lugarNacimiento' => $model->lugar_nacimiento, 'estadoCivil' => $estadoCivil, 'direccion' => $model->direccion_paciente, 'tlfHab' => $model->telefono_habitacion, 
				'tlfCel' => $model->telefono_celular, 'seguro' => $seguroMedico, 'profesion' => $model->profesion_paciente);
		}		

		echo CJSON::encode($result);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('HistoriaMedica');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HistoriaMedica('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HistoriaMedica']))
			$model->attributes=$_GET['HistoriaMedica'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=HistoriaMedica::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='historia-medica-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
