<?php

class ConfiguracionReporteController extends Controller
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
				'actions'=>array('create','update'),
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
		$dataProvider=new CActiveDataProvider('ConfiguracionReporte');

		$dt=$dataProvider->getItemCount();
		$dtId=$dataProvider->getKeys();

		if($dt<=0)
		{
			$model=new ConfiguracionReporte;
		}
		else
		{
			$model=$this->loadModel($dtId);
			$img=ConfiguracionReporte::model()->findByPk($dtId);
			//$model->_imagenLogo=$img->ubicacion_logo;
		}

        if(isset($_POST['ConfiguracionReporte']))
        {
            $model->attributes=$_POST['ConfiguracionReporte'];
            $model->_imagenLogo=CUploadedFile::getInstance($model,'_imagenLogo');
            
            if(is_object($model->_imagenLogo))
			{
			    $size=$model->_imagenLogo->getSize();
	            $ext=$model->_imagenLogo->getExtensionName();
	            $model->ubicacion_logo='logo.'.$ext;

	            if($size<=2000000)
	            {
	            	if($ext=='png' || $ext=='jpg' || $ext=='jpeg')
	            	{
			            if($model->save())
			            {
			            	$ext=$model->_imagenLogo->getExtensionName();
			                $model->_imagenLogo->saveAs('data_img/logos/logo.'.$ext);
			                $this->redirect(array('view','id'=>$model->configuracion_reporte_id));
			            }
			        }
			        else
		        	{
		                Yii::app()->user->setFlash('error_imagen','Imagen no valida. Los formatos permitidos son: .png y .jpg');
		            }
	        	}
	        	else
	        	{
	                Yii::app()->user->setFlash('error_imagen','La imagen debe ser de maximo 2MB');
	            }
			}
			elseif (isset($img)) 
			{
				ConfiguracionReporte::model()->updateByPk($model->configuracion_reporte_id, array('titulo_reporte' =>  $model->titulo_reporte, 'subtitulo_1' =>  $model->subtitulo_1, 'subtitulo_2' =>  $model->subtitulo_2, 'subtitulo_3' =>  $model->subtitulo_3, 'subtitulo_4' =>  $model->subtitulo_4) );

				$this->redirect(array('view','id'=>$model->configuracion_reporte_id));
				
			}
			else
        	{
                Yii::app()->user->setFlash('error_imagen','Debe seleccionar una imagen');
            }
            
        }
        $this->render('create', array('model'=>$model));
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

		if(isset($_POST['ConfiguracionReporte']))
		{
			$model->attributes=$_POST['ConfiguracionReporte'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->configuracion_reporte_id));
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
		$dataProvider=new CActiveDataProvider('ConfiguracionReporte');

		$dt=$dataProvider->getItemCount();
		$dtId=$dataProvider->getKeys();
		
		if($dt<=0)
		{
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
		}
		else
		{
			$this->render('view',array(
				'model'=>$this->loadModel($dtId),
			));
		}

		
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ConfiguracionReporte('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ConfiguracionReporte']))
			$model->attributes=$_GET['ConfiguracionReporte'];

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
		$model=ConfiguracionReporte::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='configuracion-reporte-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
