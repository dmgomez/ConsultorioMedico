<?php

date_default_timezone_set('America/Caracas');

class PacienteController extends Controller
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
				'actions'=>array('index','view','create','update','delete','admin','subirFoto'),
				'expression'=> '!Yii::app()->user->isGuest && (Yii::app()->user->getState(\'tipo_usuario\')==1 || Yii::app()->user->getState(\'tipo_usuario\')==2 || Yii::app()->user->getState(\'tipo_usuario\')==4)',
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
		$model=new Paciente;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Paciente'])){

			$model->attributes=$_POST['Paciente'];
			$model->fecha_nacimiento = Funciones::invertirFecha($model->fecha_nacimiento);
			$model->ult_mod = date('Y-m-d H:i:s');
			$model->usuario_id_mod = Yii::app()->user->getState('usuario_id');			

			if($model->save()){

				Yii::app()->user->setFlash('success', 'Registro creado satisfactoriamente.');

				if(file_exists('data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png')){
					
					rename('data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png', 'data_img/pacientes/' . $model->cedula_paciente . '-' . $model->paciente_id . '.png');	
				}
				
				$this->redirect(array('view','id'=>$model->paciente_id));
			}				
		}

		$this->render('create',array('model'=>$model,));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->fecha_nacimiento = Funciones::invertirFecha($model->fecha_nacimiento);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Paciente']))
		{
			$model->attributes=$_POST['Paciente'];

			$model->fecha_nacimiento = Funciones::invertirFecha($model->fecha_nacimiento);
			$model->ult_mod = date('Y-m-d H:i:s');
			$model->usuario_id_mod = Yii::app()->user->getState('usuario_id');

			if($model->save()){

				Yii::app()->user->setFlash('success', 'Registro actualizado satisfactoriamente.');

				if(file_exists('data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png')){
					rename('data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png', 'data_img/pacientes/' . $model->cedula_paciente . '-' . $model->paciente_id . '.png');	
				}

				$this->redirect(array('view','id'=>$model->paciente_id));
			}				
		}

		//Borra cualquier imagen temporal que haya capturado este usuario.
		//unlink('data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png');

		$this->render('update',array('model'=>$model,));
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
			try {

				$this->loadModel($id)->delete();
				Yii::app()->user->setFlash('success', 'Registro eliminado satisfactoriamente.');

			} catch (Exception $e) {
				
				Yii::app()->user->setFlash('error', 'Error. No se puede eliminar ya que tiene citas o historia asociadas. Contacte a su administrador de Sistemas.');
			}

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
		$model=new Paciente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Paciente']))
			$model->attributes=$_GET['Paciente'];

		$this->render('admin',array(
			'model'=>$model,
		));

		//Borra cualquier imagen temporal que haya capturado este usuario.
		if(file_exists('data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png')){
			unlink('data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png');	
		}
		

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Paciente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Paciente']))
			$model->attributes=$_GET['Paciente'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionSubirFoto(){
		
		$result = array('success' => false);

		$img = $_POST['img64'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = 'data_img/pacientes/' . Yii::app()->user->getState('usuario_id') . '.png';
		$success = file_put_contents($file, $data);

		$result = array('success' => true, 'img'=>$_POST['img64']);

		echo CJSON::encode($result);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Paciente::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='paciente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}