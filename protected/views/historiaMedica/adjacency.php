<?php
	$this->widget('application.extensions.MTreeView.MTreeView',array(
		'collapsed'=>true,
		'animated'=>'fast',
		//---MTreeView options from here
		'table'=>'historia_medica_consulta',//what table the menu would come from
		'hierModel'=>'adjacency',//hierarchy model of the table
		'conditions'=>array('visible=:visible',array(':visible'=>1)),//other conditions if any                                    
		'fields'=>array(//declaration of fields
			'text'=>'title',//no `text` column, use `title` instead
			'alt'=>false,//skip using `alt` column
			'id_parent'=>'parent_id',//no `id_parent` column,use `parent_id` instead
			'task'=>false,
			'icon'=>false,
			'url'=>array('/historiaMedicaConsulta/view',array('id'=>'id'))
			//'url'=>"CONCAT('/',title,'/id',id)"
		),
	));
?>


