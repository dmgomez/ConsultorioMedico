<?php

class FarmacoController extends Controller
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
			array('allow',
				'actions'=>array('index','view','create','update','delete','admin'),
				'expression'=> '!Yii::app()->user->isGuest && (Yii::app()->user->getState(\'tipo_usuario\')==1 || Yii::app()->user->getState(\'tipo_usuario\')==2 || Yii::app()->user->getState(\'tipo_usuario\')==3)',
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
		$model=new Farmaco;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Farmaco']))
		{
			$model->attributes=$_POST['Farmaco'];
			if($model->save()){

				Yii::app()->user->setFlash('success', 'Registro creado satisfactoriamente.');
				$this->redirect(array('view','id'=>$model->farmaco_id));
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Farmaco']))
		{
			$model->attributes=$_POST['Farmaco'];
			if($model->save()){

				Yii::app()->user->setFlash('success', 'Registro actualizado satisfactoriamente.');
				$this->redirect(array('view','id'=>$model->farmaco_id));
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
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			try {

				$this->loadModel($id)->delete();
				Yii::app()->user->setFlash('success', 'Registro eliminado satisfactoriamente.');

			} catch (Exception $e) {
				
				Yii::app()->user->setFlash('error', 'Error. No se puede eliminar ya que tiene registros asociados. Contacte a su administrador de Sistemas.');
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
		$model=new Farmaco('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Farmaco']))
			$model->attributes=$_GET['Farmaco'];

		/*print_r(Usuario::model()->get_UsuariosPorTipos(array('1,2')));
		print_r(array('admin', 'jsilva', 'jquintero'));
		die();*/

		$this->render('admin',array(
			'model'=>$model,
		));		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Farmaco('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Farmaco']))
			$model->attributes=$_GET['Farmaco'];

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
		$model=Farmaco::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='farmaco-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}