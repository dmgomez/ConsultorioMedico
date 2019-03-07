<?php

class ConsultaController extends Controller
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
				'actions'=>array('create','update', 'BuscarPacientePorID', 'BuscarPatologiaPorID', 'AgregarPatologia', 'EliminarPatologia', 'DeletePatologia'),
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
		$model=new Consulta;
		$fechaHoy=date('d-m-Y');
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Consulta']))
		{
			$model->attributes=$_POST['Consulta'];
			$model->fecha_consulta = Funciones::invertirFecha($model->fecha_consulta);
			$model->ult_mod = date('Y-m-d H:i:s');

			$model->usuario_id = Yii::app()->user->getState('usuario_id');
		
			if($model->diagnosticoId=="")
			{
				$model->diagnosticoId=",";
			}	
			if($model->antecedentePaciente=="")
			{
				$model->antecedentePaciente=".     .";
			}

			if($model->save())
			{
				$patologias=explode(',', $model->diagnosticoId);

				foreach ($patologias as $key => $value) 
				{
					if($value!="")
					{
						try
						{
							$command = new ConsultaPatologia();
							$command->consulta_id = $model->consulta_id;
							$command->patologia_id = $value;
							$command->save();
		               	}
						catch (Exception $e)
						{
						  	if(strpos($e, 'Duplicate entry'))
						  	{
						  		$nombreRepetida=Patologia::model()->findByPk($value);
						  		$repetidas.=$nombreRepetida->descripcion_patologia.', ';
						  	}
						}
					}
				}
				if(isset($repetidas) && $repetidas!="")
				{
					$repetidas=substr($repetidas, 0, -2);
					Yii::app()->user->setFlash("error", "Intentó ingresar las siguientes patologias mas de una vez: $repetidas");
				  	$this->redirect(array('view','id'=>$model->consulta_id));
				}

				$antecedentes=$model->antecedentePaciente;
				$antecedenteTabla = Paciente::model()->findByAttributes( array('paciente_id' => $model->paciente_id) );
				if($antecedenteTabla->antecedente_paciente !== $antecedentes && $antecedentes!=='.     .')
				{
					$updateAntecedente = Paciente::model()->updateByPk($model->paciente_id, array('antecedente_paciente' => $antecedentes) );
				}
				
				Yii::app()->user->setFlash('success', 'Registro creado satisfactoriamente.');
				$this->redirect(array('view','id'=>$model->consulta_id));
			}
				
		}

		$this->render('create',array(
			'model'=>$model, 'fechaHoy'=>$fechaHoy,
		));
	}

	public function actionAgregarPatologia(){

		$result = array('success' => false, 'mensaje' => 'No se pudo agregar el registro. Sólo se permiten caracteres alfanuméricos');
		
		$patologia = $_POST['patologia'];

		$patologiasAgregadas = $_POST['patologiasAgregadas'];

		$command = Yii::app()->db->createCommand();
		if($patologia != "")
		{
			if( preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ\s]+$/', $patologia) )
			{
				$buscar = Patologia::model()->findByAttributes( array('descripcion_patologia'=>$patologia) );
				if(!$buscar)
				{
					$command->insert('patologia', array(
				        'descripcion_patologia'=>$patologia,
				    ));

				}

			    $model = Patologia::model()->findByAttributes( array('descripcion_patologia'=>$patologia) );

			    $patologiasAgregadas=explode(",", $patologiasAgregadas);

				$agregada=0;
				for ($i=0; $i < count($patologiasAgregadas); $i++) 
				{ 
					if($patologiasAgregadas[$i]==$model->patologia_id)
					{
						$agregada=1;
						break;
					}
				}

				if($agregada==1)
				{
					$result = array('success' => false, 'mensaje' => 'La patologia que intenta agregar ya se encuentra registrada para el paciente');
				}
				else
				{
				    $image = CHtml::image(Yii::app()->theme->baseUrl.'/images/Trash.png', 'Eliminar',  array("class"=>"borra_patologia", "value"=>$model->patologia_id, "id"=>$model->patologia_id));
				    $patologia='<label id="'.$model->patologia_id.'">'. $model->descripcion_patologia." ".$image. '</label>';

				    $result = array('success' => true, 'patologia' => $model->descripcion_patologia, 'patologiaBorrar' => $patologia, 'id' => $model->patologia_id, 'mensaje' => '');
				}

			    
			}
		}

		echo CJSON::encode($result);
	}



	public function actionBuscarPacientePorID($ID){

		$result = array('success' => false, 'mensaje' => 'No se encuentra ningun paciente con esa cédula.');			

		$model = Paciente::model()->findByAttributes( array('paciente_id' => $ID) );
		
		if($model)
		{
			$fechaHoy=date('Y-m-d');
			$consultaAsignada = Consulta::model()->findByAttributes( array('paciente_id' => $ID, 'fecha_consulta' => $fechaHoy) );

			if($consultaAsignada)
			{
				$result = array('success' => false, 'mensaje' => 'El paciente seleccionado ya tiene una consulta para este dia');
			}
			else
			{
				$result = array('success' => true, 'paciente' => $model->nombre_paciente.' '.$model->apellido_paciente, 'id' => $model->paciente_id, 'antecedente' => $model->antecedente_paciente);
			}
		}		

		echo CJSON::encode($result);
	}

	public function actionBuscarPatologiaPorID($ID){

		$result = array('success' => false, 'mensaje' => 'No se encuentra ninguna patologia con esa descripciòn.');

		$patologiasAgregadas = $_POST['patologiasAgregadas'];

		$model = Patologia::model()->findByAttributes( array('patologia_id' => $ID) );
		
		if($model)
		{
			$patologiasAgregadas=explode(",", $patologiasAgregadas);
			$agregada=0;
			for ($i=0; $i < count($patologiasAgregadas); $i++) 
			{ 
				if($patologiasAgregadas[$i]==$model->patologia_id)
				{
					$agregada=1;
					break;
				}
			}

			if($agregada==1)
			{
				$result = array('success' => false, 'mensaje' => 'La patologia que intenta agregar ya se encuentra registrada para el paciente');
			}
			else
			{
				$image = CHtml::image(Yii::app()->theme->baseUrl.'/images/Trash.png', 'Eliminar',  array("class"=>"borra_patologia", "value"=>$ID, "id"=>$ID));
				
				$patologia='<label id="'.$ID.'">'.$model->descripcion_patologia." ".$image.'</label>';

				$result = array('success' => true, 'descripcion' => $model->descripcion_patologia, 'patologiaBorrar' => $patologia, 'id' => $model->patologia_id, 'mensaje' => '');
			}
		}		

		echo CJSON::encode($result);

	}

	public function actionEliminarPatologia()
	{
		$patologia_id=$_POST['patologia_id'];
		$diagnostico_id=$_POST['idDiagnostico'];
		
		$diagnostico_id=explode(",", $diagnostico_id);

		for ($i=0; $i < count($diagnostico_id); $i++) 
		{ 
			if($diagnostico_id[$i]==$patologia_id || $diagnostico_id[$i]=="")
			{
				unset($diagnostico_id[$i]);
			}
		}
		$diagnostico_id = array_values($diagnostico_id);
		$diagnostico_id = implode(",", $diagnostico_id);
		
		$result = array('success' => true, 'id' => $patologia_id, 'idDiag' => $diagnostico_id);

		echo CJSON::encode($result);
		
	}

	public function actionDeletePatologia($consulta_id,$patologia_id,$patologia_descripcion)
	{
		$diagnostico_id=$_POST['idDiagnostico'];
		
		$diagnostico_id=explode(",", $diagnostico_id);

		for ($i=0; $i < count($diagnostico_id); $i++) 
		{ 
			if($diagnostico_id[$i]==$patologia_id || $diagnostico_id[$i]=="")
			{
				unset($diagnostico_id[$i]);
			}
		}
		$diagnostico_id = array_values($diagnostico_id);
		$diagnostico_id = implode(",", $diagnostico_id);
		$diagnostico_id = $diagnostico_id;

		$result = array('success' => true, 'id' => $patologia_id, 'idDiag' => $diagnostico_id);

		echo CJSON::encode($result);

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

		if(isset($_POST['Consulta']))
		{
			$model->attributes=$_POST['Consulta'];
			$model->fecha_consulta = Funciones::invertirFecha($model->fecha_consulta);
			$model->ult_mod = date('Y-m-d H:i:s');
			$model->usuario_id_mod = Yii::app()->user->getState('usuario_id');
			if($model->diagnosticoId=="")
			{
				$model->diagnosticoId=",";
			}	
			if($model->antecedentePaciente=="")
			{
				$model->antecedentePaciente="¡NINGUNO!";
			}

			if($model->save())
			{
				$antecedentes=$model->antecedentePaciente;
				$antecedenteTabla = Paciente::model()->findByAttributes( array('paciente_id' => $model->paciente_id) );
				if($antecedenteTabla->antecedente_paciente !== $antecedentes && $antecedentes!=='¡NINGUNO!')
				{
					$updateAntecedente = Paciente::model()->updateByPk($model->paciente_id, array('antecedente_paciente' => $antecedentes) );
				}

				$delete=ConsultaPatologia::model()->deleteAllByAttributes(array('consulta_id' => $model->consulta_id) );

				$patologias=explode(',', $model->diagnosticoId);
				$repetidas='';
				foreach ($patologias as $key => $value) 
				{
					
					if($value!="")
					{
						try
						{
							$command = new ConsultaPatologia();
							$command->consulta_id = $model->consulta_id;
							$command->patologia_id = $value;
							$command->save();
		               	}
						catch (Exception $e)
						{
						  	if(strpos($e, 'Duplicate entry'))
						  	{
						  		$nombreRepetida=Patologia::model()->findByPk($value);
						  		$repetidas.=$nombreRepetida->descripcion_patologia.', ';
						  	}
						}
					}
				}

				if($repetidas!="")
				{
					$repetidas=substr($repetidas, 0, -2);
					Yii::app()->user->setFlash("error", "Intentó ingresar las siguientes patologias mas de una vez: $repetidas");
				  	$this->redirect(array('view','id'=>$model->consulta_id));
				}

				$this->redirect(array('view','id'=>$model->consulta_id));
			}
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

			$deleteId='';
			$getId = ConsultaPatologia::model()->findAllByAttributes( array('consulta_id' => $id) );
			foreach ($getId as $value) 
			{
				$deleteId.=$value['consulta_patologia_id'].',';
			}
			$deleteId = substr($deleteId, 0, -1);

			$find = ConsultaPatologia::model()->findByAttributes(array('consulta_id' => $id) );

			if($find)
			{
				$transaction=Yii::app()->db->beginTransaction();
				$delete=ConsultaPatologia::model()->deleteAllByAttributes(array('consulta_id' => $id) );

				if ($delete) 
				{

					if($this->loadModel($id)->delete())
					{
						$transaction->commit();
					}
					else
					{
						$transaction->rollback();
					}
				}

			}
			else
			{
				$this->loadModel($id)->delete();
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
		$model=new Consulta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Consulta']))
			$model->attributes=$_GET['Consulta'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Consulta('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Consulta']))
			$model->attributes=$_GET['Consulta'];

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
		$model=Consulta::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='consulta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
