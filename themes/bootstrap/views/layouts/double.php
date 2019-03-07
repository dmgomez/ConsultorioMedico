<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div id="content" class="span-11">
		<h2>Datos del Paciente</h2>
		<?php echo $content; ?>

		<div id="arbol" class="span-11">
			<h2>Consultas Realizadas</h2>
			<div id="arbol-content">
				<?php $this->widget('application.extensions.MTreeView.MTreeView',array(
					'collapsed'=>true,
					'animated'=>'fast',
					//---MTreeView options from here
					'table'=>'historia_medica_consulta',//what table the menu would come from
					'hierModel'=>'adjacency',//hierarchy model of the table
					'conditions'=>array('visible=:visible',array(':visible'=>1)),//other conditions if any                                    
					'fields'=>array(//declaration of fields
						'consulta'=>'consulta_id',
						'historia'=>'historia_medica_id',
						'text'=>'title',//no `text` column, use `title` instead
						'alt'=>false,//skip using `alt` column
						'id_parent'=>'parent_id',//no `id_parent` column,use `parent_id` instead
						'task'=>false,
						'icon'=>false,
						'url'=>array('/historiaMedicaConsulta/view',array('id'=>'id'))
						//'url'=>"CONCAT('/',title,'/id',id)"
					),
				)); ?>
			</div>
		</div>
	</div><!-- content -->
	<div class="span-11">
		<p>
			<h2>Datos de la Consulta</h2>
			<div class="row-fluid">
		        <div id="pdf" class="span12">
		        <?php 
		           /* $this->widget('bootstrap.widgets.TbMenu', array(
		                'items'=>$this->menu,
		                'htmlOptions'=>array('class'=>'nav nav-pills'),
		            ));*/
		        ?>     
		        </div>
		    </div>
		</p>

	</div>
</div>
<?php $this->endContent(); ?>
