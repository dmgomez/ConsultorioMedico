<?php

class PrincipalAdministrativoController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */	
	public function actionIndex()
	{
		if(Yii::app()->user->isGuest){
			$this->redirect(array('Inicio/login'));
		}
		else{

			//Redirigir al Usuario a la Pantalla Principal que le corresponda.
			$this->render('index');
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
	 * Displays the login page
	 */
	public function actionLogin($blnMostrarMensaje = 0)
	{
		$this->layout="login";
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){

				if($model->getErrorCode() == UserIdentity::ERROR_USERNAME_RESTART_PASSWORD)
					$this->redirect(array('Inicio/resetpassword', 'username'=>$model->username));
				else
					$this->redirect(array('Inicio/index'));									
			}
		}

		// display the login form
		$this->render('login', array('model'=>$model, 'blnMostrarMensaje'=>$blnMostrarMensaje));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('Inicio/login'));
	}	

	public function actionResetPassword($username){

		$this->layout="login";

		$model=new ResetPasswordForm;
		// display the reset password form
		$this->render('resetpassword', array('model'=>$model, 'username'=>$username));
	}

	public function actionChangePassword($username){

		$this->layout="main";

		$model=new ChangePasswordForm;
		// display the change password form
		$this->render('changepassword', array('model'=>$model, 'username'=>$username));
	}
	
	public function actionCambiarClave($username){

		$model =new ResetPasswordForm;

		if(isset($_POST['ResetPasswordForm']))
		{
			$model->attributes=$_POST['ResetPasswordForm'];

			if($model->validate()){

				$usuario = Usuario::model()->find("LOWER(login_usuario)=?", array(strtolower($username)));

				if($usuario->reset_clave == 1){

					$usuario->clave_usuario = sha1($model->password);
					$usuario->reset_clave = 0;

					$usuario->save();

					$this->redirect(array('Inicio/login', 'blnMostrarMensaje'=>1));
				}
			}
			else{
				$this->render('resetpassword', array('model'=>$model, 'username'=>$username));
			}
		}
		elseif(isset($_POST['ChangePasswordForm']))
		{
			$model->attributes=$_POST['ChangePasswordForm'];

			if($model->validate()){

				$usuario = Usuario::model()->find("LOWER(login_usuario)=?", array(strtolower($username)));
				$usuario->clave_usuario = sha1($model->password);
				$usuario->reset_clave = 0;
				$usuario->save();
				$this->redirect(array('Inicio/index'));
			}
			else{
				$this->render('changepassword', array('model'=>$model, 'username'=>$username));
			}
		}
	}

}