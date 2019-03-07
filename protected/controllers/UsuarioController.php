<?php

class UsuarioController extends Controller
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
				'actions'=>array('index','view','create','update','delete','admin','resetpassword'),
				'expression'=> '!Yii::app()->user->isGuest && (Yii::app()->user->getState(\'tipo_usuario\')==1 || Yii::app()->user->getState(\'tipo_usuario\')==2)',
			),
			array('allow', //Permite a todos los usuarios acceder a la Accion resetpassword del Controlador
				'actions'=>array('resetpassword'),
				'expression'=> '!Yii::app()->user->isGuest',
			),
			array('deny',  //Deny all users
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
		$model=new Usuario;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{

			$model->attributes=$_POST['Usuario'];
			$model->clave_usuario = sha1($model->clave_usuario);

			if($model->save()){

				Yii::app()->user->setFlash('success', 'Registro creado satisfactoriamente.');				
				$this->redirect(array('view','id'=>$model->usuario_id));
			}
			else{
				$model->clave_usuario = "";
				$model->clave_usuario_repeat = "";
			}
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
	public function actionUpdate($id){

		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];

			if($model->save()){

				Yii::app()->user->setFlash('success', 'Registro actualizado satisfactoriamente.');
				$this->redirect(array('view','id'=>$model->usuario_id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id){

		if(Yii::app()->request->isPostRequest)
		{

			try {

				$this->loadModel($id)->delete();
				Yii::app()->user->setFlash('success', 'Registro eliminado satisfactoriamente.');

			} catch (Exception $e) {
				
				Yii::app()->user->setFlash('error', 'Error. No se puede eliminar ya que tiene citas asociadas. Pruebe desactivando al usuario.');
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect( array('admin') );
		}
		else{

			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
			
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex(){

		$model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionResetPassword($identificador){
		$result = array('success' => false);
		$model=$this->loadModel($identificador);
		$model->reset_clave = 1;
		if($model->save()){
			$result = array('success' => true);
		}
		
		echo CJSON::encode($result);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

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
		$model=Usuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'El registro no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}