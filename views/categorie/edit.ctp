<header><h2><?php __('Edit Categoria'); ?></h2>
<ul class="actions">
	<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Categoria.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Categoria.id'))); ?></li>
	<li><?php echo $this->Html->link(__('List Categorie', true), array('action' => 'index'));?></li>
	<li><?php echo $this->Html->link(__('List Eventi', true), array('controller' => 'eventi', 'action' => 'index')); ?> </li>
	<li><?php echo $this->Html->link(__('New Evento', true), array('controller' => 'eventi', 'action' => 'add')); ?> </li>
</ul>
</header>
<article class="categorie form">
<?php echo $this->Form->create('Categoria');?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('categoria');
        ?>
    
        <style>
	#red, #green, #blue {
		float: left;
		clear: left;
		width: 300px;
		margin: 15px;
	}
	#swatch {
		width: 120px;
		height: 100px;
		margin-top: 18px;
		margin-left: 350px;
		background-image: none;
	}
	#red .ui-slider-range { background: #ef2929; }
	#red .ui-slider-handle { border-color: #ef2929; }
	#green .ui-slider-range { background: #8ae234; }
	#green .ui-slider-handle { border-color: #8ae234; }
	#blue .ui-slider-range { background: #729fcf; }
	#blue .ui-slider-handle { border-color: #729fcf; }
	#demo-frame > div.demo { padding: 10px !important; };
	</style>
	<script>
	function hexFromRGB(r, g, b) {
		var hex = [
			r.toString( 16 ),
			g.toString( 16 ),
			b.toString( 16 )
		];
		$.each( hex, function( nr, val ) {
			if ( val.length === 1 ) {
				hex[ nr ] = "0" + val;
			}
		});
		return hex.join( "" ).toUpperCase();
	}
	function refreshSwatch() {
		var red = $( "#red" ).slider( "value" ),
			green = $( "#green" ).slider( "value" ),
			blue = $( "#blue" ).slider( "value" ),
			hex = hexFromRGB( red, green, blue );
		$( "#swatch" ).css( "background-color", "#" + hex );
                
                $( "#CategoriaColore ").val(hex);
	}
	$(function() {
		$( "#red, #green, #blue" ).slider({
			orientation: "horizontal",
			range: "min",
			max: 255,
			value: 127,
			slide: refreshSwatch,
			change: refreshSwatch
		});
		$( "#red" ).slider( "value", 255 );
		$( "#green" ).slider( "value", 140 );
		$( "#blue" ).slider( "value", 60 );
	});
	</script>



<div class="demo">

<p class="ui-state-default ui-corner-all ui-helper-clearfix" style="padding:4px;">
	<span class="ui-icon ui-icon-pencil" style="float:left; margin:-2px 5px 0 0;"></span>
	Simple Colorpicker
</p>

<div id="red"></div>
<div id="green"></div>
<div id="blue"></div>

<div id="swatch" class="ui-widget-content ui-corner-all"></div>

</div><!-- End demo -->
    
<div style="clear:both;"></div>
<p>Colore attuale:</p>
<div style="float:left; height:22px; width:22px; margin:4px; background-color: #<?php echo $this->data['Categoria']['colore']?>">&nbsp;&nbsp; 
</div> <p>#<?php echo $this->data['Categoria']['colore']?></p>
        <?php
                echo $this->Form->input('colore');
                echo $this->Form->input('ha_edizioni', array('label' => 'Gestire edizioni? (es. puntate, numeri)'));
		
		//echo $this->Form->input('Evento');
	?>
<?php echo $this->Form->end(__('Submit', true));?>
</article>