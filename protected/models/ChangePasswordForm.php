<?php
class ChangePasswordForm extends CFormModel
{
	public $password;
	public $password_repeat;

	public function rules()
	{
		return array(
			// username and password are required
			array('password, password_repeat', 'required'),
			// password tiene que ser comparado
			array('password', 'Comparar_Claves'),
		);
	}	

	public function Comparar_Claves($attribute, $params)
	{
		if ($this->password != $this->password_repeat){
			$this->addError($attribute,"Las nuevas claves deben coincidir.");
		}
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(			
			'password'=>'Nueva Clave',
			'password_repeat'=>'Confirmar Nueva Clave',
		);
	}
}
?>