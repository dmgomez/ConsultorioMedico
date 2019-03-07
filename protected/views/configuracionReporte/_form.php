<style type="text/css">
/*div.form .errorSummary
{
	border: 2px solid #C00;
	padding: 7px 7px 12px 7px;
	margin: 0 0 20px 0;
	background: #FEE;
	font-size: 0.9em;
}
div.form .errorSummary p
{
	margin: 0;
	padding: 5px;
}

div.form .errorSummary ul
{
	margin: 0;
	padding: 0 0 0 20px;
}*/
div.flash-error, div.flash-notice, div.flash-success
{
	padding:.8em;
	margin-bottom:1em;
	border:2px solid #ddd;
}

div.flash-error
{
	background:#FBE3E4;
	color:#8a1f11;
	border-color:#FBC2C4;
}
div.flash-error a
{
	color:#8a1f11;
}
</style>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'configuracion-reporte-form',
	//'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Los campos con <span class="required">*</span> son requeridos.</p><br>

	<?php echo $form->errorSummary($model); ?>

	 <?php
	 if(Yii::app()->user->hasFlash("error_imagen"))
	 {?>
		<div class="flash-error">
		    <?php echo Yii::app()->user->getFlash("error_imagen"); ?>
		</div>
	<?php }
	?>

	<?php echo $form->labelEx($model, '_imagenLogo'); ?>
	<?php echo $form->fileField($model, '_imagenLogo'); ?>
	<?php echo $form->error($model, '_imagenLogo'); ?>

	<?php echo $form->textFieldRow($model,'titulo_reporte',array('class'=>'span5','maxlength'=>36)); ?>

	<?php echo $form->textFieldRow($model,'subtitulo_1',array('class'=>'span5','maxlength'=>36)); ?>

	<?php echo $form->textFieldRow($model,'subtitulo_2',array('class'=>'span5','maxlength'=>36)); ?>

	<?php echo $form->textFieldRow($model,'subtitulo_3',array('class'=>'span5','maxlength'=>36)); ?>

	<?php echo $form->textFieldRow($model,'subtitulo_4',array('class'=>'span5','maxlength'=>36)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
