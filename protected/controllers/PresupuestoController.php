<?php

class PresupuestoController extends Controller
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
				'actions'=>array('create','update', 'BuscarPacientePorCedula', 'BuscarPacientePorID', 'ActualizarTotal', 'GenerarPdf'),
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
		$model=new Presupuesto;
		$fechaHoy=date('d-m-Y');

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Presupuesto']))
		{
			$model->attributes=$_POST['Presupuesto'];
			$model->fecha_presupuesto = Funciones::invertirFecha($model->fecha_presupuesto);

			if($model->save())
				$this->redirect(array('view','id'=>$model->presupuesto_id));
		}

		$this->render('create',array(
			'model'=>$model,
			'fechaHoy'=>$fechaHoy,
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
		$fechaHoy=date('d-m-Y');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Presupuesto']))
		{
			$model->attributes=$_POST['Presupuesto'];
			$model->fecha_presupuesto = Funciones::invertirFecha($model->fecha_presupuesto);
			if($model->save())
				$this->redirect(array('view','id'=>$model->presupuesto_id));
		}

		$this->render('update',array(
			'model'=>$model,
			'fechaHoy'=>$fechaHoy,
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
		$model=new Presupuesto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Presupuesto']))
			$model->attributes=$_GET['Presupuesto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Presupuesto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Presupuesto']))
			$model->attributes=$_GET['Presupuesto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionGenerarPdf($id)
	{
		$sqlDatosReporte="SELECT * from configuracion_reporte";
		$datosReportes = Yii::app()->db->createCommand($sqlDatosReporte)->queryRow();

	 	$model=$this->loadModel($id);
	 	$mPDF1 = Yii::app()->ePdf->mpdf('utf-8','A4','','',15,15,35,25,9,9,'P'); 
	 	$mPDF1->SetTitle("Presupuesto");
	 	$mPDF1->SetDisplayMode('fullpage');
	 	$mPDF1->WriteHTML($this->renderPartial('pdfReport', array('model'=>$model, 'cabecera'=>$datosReportes), true)); 
	 	$mPDF1->Output('Presupuesto'.date('YmdHis'),'I');  //Nombre del pdf y parámetro para ver pdf o descargarlo directamente.
	}

	/*
	*	Regresa los datos principales del paciente al buscarlo por cédula.
	*/
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

			$result = array('success' => true, 'cedula' => $model->cedula_paciente, 'paciente' => $model->nombre_paciente.' '.$model->apellido_paciente, 'id' => $model->paciente_id, 'edad' => $edad);
		}		

		echo CJSON::encode($result);
	}

	public function actionBuscarPacientePorID($ID){

		$result = array('success' => false);			

		$model = Paciente::model()->findByAttributes( array('paciente_id' => $ID) );
		
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

			$result = array('success' => true, 'cedula' => $model->cedula_paciente, 'paciente' => $model->nombre_paciente.' '.$model->apellido_paciente, 'id' => $model->paciente_id, 'edad' => $edad);
		}		

		echo CJSON::encode($result);
	}

/*	public function actionActualizarTotal(){

		$result = array('success' => false);
		
		$monto = $_POST['monto'];

		$total = $_POST['total'];

		$total += $monto;
		
		$result = array('success' => true, 'total' => $total);		

		echo CJSON::encode($result);
	}*/

	public function actionActualizarTotal(){

		$result = array('success' => false);
		
		$medico = $_POST['medico'];
		$cirujano = $_POST['cirujano'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$anestesiologo = $_POST['anestesiologo'];
		$tecnico = $_POST['tecnico'];
		$urovideo = $_POST['urovideo'];
		$instrumental = $_POST['instrumental'];
		$interconsulta = $_POST['interconsulta'];
		$total = $_POST['total'];

		$total =  $medico + $cirujano + $a1 + $a2 + $anestesiologo + $tecnico + $urovideo + $instrumental + $interconsulta;
		
		$result = array('success' => true, 'total' => $total);		

		echo CJSON::encode($result);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Presupuesto::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='presupuesto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
