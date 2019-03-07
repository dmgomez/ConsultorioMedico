<?php

$this->pageTitle=Yii::app()->name . ' - Cambio de Clave';

$this->breadcrumbs=array(
	'Cambio de Clave'
);

?>

<h1>Cambio de Clave para el Usuario (<?php echo $username; ?>)</h1>

<p>Ingrese su nueva clave y la confirmación de su nueva clave.</p>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'change-form',
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
            'type'=>'primary',
            'label'=>'Cambiar Clave',
        )); 
        ?>
    	</div>
	</div>

<?php $this->endWidget(); ?>