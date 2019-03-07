<?php

class InicioAdministrativoController extends Controller
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
			array('allow',  //Permite a los usuarios Administrador y Doctor Avanzado acceder a las acciones del Controlador
				'actions'=>array('index', 'CambiarEstadoCita', 'CreateCita'),
				'expression'=> '!Yii::app()->user->isGuest && (Yii::app()->user->getState(\'tipo_usuario\')==1 || Yii::app()->user->getState(\'tipo_usuario\')==2 || Yii::app()->user->getState(\'tipo_usuario\')==4)',
			),
			array('deny',  //Deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

		$model=new Cita('search');
		$model->unsetAttributes();  // clear any default values

		if( isset($_GET['Cita']) ){

			$model->attributes = $_GET['Cita'];
			$this->render('index_administrativo', array('model'=>$model));
		}
		else{

			$model->fecha_cita = date('d-m-Y');
			$this->render('index_administrativo', array('model'=>$model));
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cita-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/*
	 *	Cambia los estados de las citas
	 */
	public function actionCambiarEstadoCita($Cita_ID){

		$result = array('retorno' => false);

		$model=Cita::model()->findByPk($Cita_ID);

		if($model->estado_cita_id == 1){

			$model->estado_cita_id = 2;

			/*
			*	Establecer orden para las citas que se van a ordenar
			*/

			$intProximoOrden = Yii::app()->db->createCommand("select max(orden_cita + 1)
															  from cita
															  where fecha_cita = '".$model->fecha_cita."' and doctor_id = ".$model->doctor_id)->queryScalar();

			$model->orden_cita = $intProximoOrden;

			if($model->save()){

				$result = array('retorno' => true);
			}

		}
		elseif($model->estado_cita_id == 2){

			$model->estado_cita_id = 3;

			if($model->save()){

				$result = array('retorno' => true);
			}

		}
		elseif($model->estado_cita_id == 3){

			$model->estado_cita_id = 4;

			if($model->save()){

				$result = array('retorno' => true);
			}

		}
		elseif($model->estado_cita_id == 4){

			$model->estado_cita_id = 5;

			if($model->save()){

				$result = array('retorno' => true);
			}

		}
		elseif($model->estado_cita_id == 5){

			$model->estado_cita_id = 1;
			$model->orden_cita = 0;

			if($model->save()){

				$result = array('retorno' => true);
			}

		}

		echo CJSON::encode($result);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateCita()
	{
		$model=new Cita;
		$model->fecha_cita = date('d-m-Y');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Cita']))
		{
			$model->attributes=$_POST['Cita'];

			$model->fecha_cita = Funciones::invertirFecha($model->fecha_cita);

			if($model->save()){

				Yii::app()->user->setFlash('success', 'Registro creado satisfactoriamente.');
				$this->redirect(array('index'));
			}

		}

		//SI FILTRO LA BUSQUEDA POR PACIENTE HAGO RENDER DEL GRID DE PACIENTES
		if(isset($_GET['Paciente'])){

			$model=new Paciente('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Paciente'])){
				$model->attributes=$_GET['Paciente'];
			}

			$this->renderPartial('grid_buscar_paciente',array(
				'model'=>$model,
			));
		}
		//SINO HAGO RENDER DE MI FORMULARIO DE CREACION DE CITAS
		else{
			$this->render('create',array(
				'model'=>$model,
			));
		}
	}
}