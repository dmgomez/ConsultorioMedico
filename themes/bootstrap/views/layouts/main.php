<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/functions.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body style="background-image:url(<?php echo Yii::app()->theme->baseUrl; ?>/images/fondo.jpg); background-attachment: fixed;">

<?php 

$Menu = new BarraMenu(Yii::app()->user->getState('tipo_usuario'));

$this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>$Menu->CrearMenu(),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'Sesión', 'url'=>'#', 
                    'visible'=>!Yii::app()->user->isGuest,                    
                    'items'=>array(
                        array('label'=>'Cambiar Clave', 'url'=>array('/Inicio/changepassword', 'username'=>Yii::app()->user->name)),
                        array('label'=>'Cerrar Sesión ('.Yii::app()->user->name.')', 'url'=>array('/Inicio/logout'))
                    ),
                )
                
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

    <div style="top: 60px; position: fixed; width: 1170px">
        <div id="flash" class="nodisplay"></div>
    </div>

    <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'block'=>true, // display a larger alert block?
            'closeText'=>false,
            'htmlOptions'=>array('id'=>'info', 'style'=>'top: 60px; position: fixed; width: 1170px;'),
        )
        );            
    ?>

    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif ?>

	<?php echo $content; ?>

	<div class="clear">&nbsp;</div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> SEM <br/>
		Todos los derechos reservados.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>