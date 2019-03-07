<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	private $_id;

	const ERROR_USERNAME_DISABLED=3;
	const ERROR_USERNAME_RESTART_PASSWORD=4;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	public function authenticate()
	{

		$usuario = Usuario::model()->find("LOWER(login_usuario)=?", array(strtolower($this->username)));

		//SI EXISTE EL USUARIO
		if($usuario){

			//SI DEBE CAMBIAR SU PASSWORD
			if($usuario->reset_clave == 1){
				$this->errorCode=self::ERROR_USERNAME_RESTART_PASSWORD;
				return false;
			}

			//SI ESTA ACTIVO
			if($usuario->activo == 0){
				$this->errorCode=self::ERROR_USERNAME_DISABLED;
				return false;				
			}

			//SI LAS CONTRASEÑAS COINCIDEN
			if(sha1($this->password) == $usuario->clave_usuario){

				//SI ESTA ACTIVO
				if($usuario->activo != 0){

					$this->errorCode=self::ERROR_NONE;

					Yii::app()->user->setState('usuario_id', $usuario->usuario_id);
					Yii::app()->user->setState('cedula', $usuario->cedula_usuario); 
					Yii::app()->user->setState('nombre', $usuario->nombre_usuario);
					Yii::app()->user->setState('apellido', $usuario->apellido_usuario);					
					Yii::app()->user->setState('descripcionUsuario', $usuario->descripcionUsuario);
					Yii::app()->user->setState('tipo_usuario', $usuario->tipo_usuario_id);

					$this->_id = $usuario->usuario_id;

					return true;
				}
				else{

					$this->errorCode=self::ERROR_USERNAME_DISABLED;
					return false;
				}
			}
			else{

					if( Yii::app()->user->hasState('intentos_login') ){

						Yii::app()->user->setState('intentos_login', (Yii::app()->user->getState('intentos_login') + 1) );

						if(Yii::app()->user->getState('intentos_login') >=3){
							$usuario->activo = 0;
							$usuario->save();
							$this->errorCode=self::ERROR_USERNAME_DISABLED;
						}
						else
							$this->errorCode=self::ERROR_PASSWORD_INVALID;	

					}
					else{

						Yii::app()->user->setState('intentos_login', 1);
						$this->errorCode=self::ERROR_PASSWORD_INVALID;
					}

					return false;
			}
		}
		else{

			$this->errorCode=self::ERROR_USERNAME_INVALID;
			return false;
		}

	}

	public function getId(){
		return $this->_id;
	}

	public function setUltimoLogueo(){

		date_default_timezone_set('America/Caracas');

		$usuario = new Usuario;
		$usuario = Usuario::model()->find("usuario_id=".$this->id);
		$usuario->ultimo_acceso = date('Y-m-d H:i:s');

		if( $usuario->save() ){
			return true;
		}
		else{
			return false;
		}

	}
}