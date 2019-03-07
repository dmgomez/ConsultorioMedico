<?php
	$this->pageTitle=Yii::app()->name . ' - Cambio de Clave';
?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<h1>Sistema de Evoluciones Médicas (S.E.M.)</h1>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<h2>Cambio de Clave para el Usuario (<?php echo $username; ?>)</h2>

<p>Su clave expiró por medidas de seguridad. Por favor llene los siguientes campos con sus nuevas credenciales de sesión:</p>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'reset-form',
    'type'=>'horizontal',
    'action'=>$this->createUrl('Inicio/cambiarclave', array('username'=>$username)),
	'enableClientValidation'=>true,
	'method'=>'POST',
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->passwordFieldRow($model,'password'); ?>

	<?php echo $form->passwordFieldRow($model,'password_repeat'); ?>

	<div class="control-group">
		<div class="controls">
		<?php 

		$this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
            'label'=>'Cambiar Clave',
        )); 
        ?>
    	</div>
	</div>

<?php $this->endWidget(); ?>