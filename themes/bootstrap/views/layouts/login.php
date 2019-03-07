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
<body style="background-image:url(<?php echo Yii::app()->theme->baseUrl; ?>/images/fondo.jpg)">

<div class="container" id="page">
<input type="hidden" id="blnMostrarMensaje" name="blnMostrarMensaje" value="<?php if(isset($_GET['blnMostrarMensaje'])) echo $_GET['blnMostrarMensaje']; ?>">

    <div style="top: 60px; position: fixed; width: 1170px">
        <div id="flash" class="nodisplay"></div>
    </div>	

	<?php echo $content; ?>

	<div class="clear">&nbsp;</div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> por Adamantium Software C.A. <br/>
		Todos los derechos reservados.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
