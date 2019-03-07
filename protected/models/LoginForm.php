<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			array('username, password', 'length', 'max'=>12),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Nombre de Usuario',
			'password'=>'Clave',			
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute, $params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username, $this->password);
			if (!$this->_identity->authenticate()) {
				switch ( $this->_identity->errorCode ) {
					case UserIdentity::ERROR_PASSWORD_INVALID:
						$this->addError('password','Clave incorrecta. Luego de 3 intentos fallidos el usuario será desactivado.');
						break;

					case UserIdentity::ERROR_USERNAME_DISABLED:
						$this->addError('username','Usuario desactivado, contacte a su administrador.');
						break;

					case UserIdentity::ERROR_USERNAME_INVALID:
						$this->addError('username','Usuario inválido.');
						break;
				}				
			}			
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username, $this->password);
			$this->_identity->authenticate();
		}

		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity, 0);
			if($this->_identity->setUltimoLogueo())
				return true;
			else
				return false;
		}
		elseif($this->_identity->errorCode===UserIdentity::ERROR_USERNAME_RESTART_PASSWORD){
			return true;
		}
		else
			return false;
	}

	public function getErrorCode(){
		return $this->_identity->errorCode;
	}
}
