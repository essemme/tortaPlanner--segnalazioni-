<!DOCTYPE HTML>
<?php echo $this->Plate->iecc('<html class="ie">', '<9'); ?> 
<?php echo $this->Plate->iecc('<html>', false); ?>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('Admin'); ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
			'layout',
			'/batch/css/batch',
		));
		echo $styles_for_layout;
		echo $this->Html->script('libs/modernizr-2.0.min');
	?>        
        
<?php
	echo $this->Plate->lib('jquery');
        //echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.6/themes/default/ui.datepicker.css');
        echo $this->Html->css('default/ui.all.css');
//        echo $this->Html->css('base/jquery.ui.datepicker.css');
	echo $this->Html->script(array(
		'jquery.equalHeight',
                'jquery-ui',
                'jquery-fluid16',
		'/batch/js/jquery',
		'script',
	));
        
	echo $scripts_for_layout;
?>
</head>
<body>
	<aside id="sidebar">
		<?php echo $this->element('layout/navigation'); ?>
	</aside>
	
	<section id="main">
		
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('email'); ?>
		<?php echo $content_for_layout; ?>
            
		<div class="spacer"></div>
	</section>

    <script lang="javascritp;">
        $(function() {
		$( "#AppuntamentoDataInizio" ).datepicker({dateFormat: 'yy-mm-dd'}, $.datepicker.regional[ "it" ] );
	});
    </script>
</body>
</html>