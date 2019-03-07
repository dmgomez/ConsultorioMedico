<?php

$this->pageTitle=Yii::app()->name . ' - Inicio de Sesión';		 
    
?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1>Sistema de Evoluciones Médicas (S.E.M.)</h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<h2>Inicio de Sesión</h2>

<p>Por favor llene los siguientes campos con sus credenciales de sesión:</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
    'action'=>$this->createUrl('Inicio/login'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->textFieldRow($model,'username'); ?>

	<?php echo $form->passwordFieldRow($model,'password'); ?>

	<div class="control-group">
		<div class="controls">
		<?php 

		$this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Iniciar Sesión',
        )); 
        ?>
    	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php

Yii::app()->clientScript->registerScript('MostrarMensaje', "

	if($('#blnMostrarMensaje').val() == 1){
		showAlertAnimatedToggled(true, 'Clave cambiada satisfactoriamente.', 'Puede proceder a iniciar sesión normalmente.', 'Error', 'No se pudo cambiar la clave. Contacte a su administrador de sistemas.');
	}
		
");

?>