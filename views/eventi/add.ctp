<header><hgroup><h1><?php __('Add Evento'); ?></h1></hgroup>
<ul class="actions">
	<li><?php echo $this->Html->link(__('List Eventi', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Categorie', true), array('controller' => 'categorie', 'action' => 'index')); ?> </li>
		
</ul>
</header>
<article class="eventi form">
<?php echo $this->Form->create('Evento');?>
	<?php
		echo $this->Form->input('che_cosa');                                      
                        
                echo $this->Form->input('Appuntamento.0.data_inizio', array('type' => 'text', 'class' => 'calendarietto'));
        ?>        
           <script>
            /*
             * CALENDARIETTO per data evento
             */

                $(function() {
                            $( ".calendarietto" ).datepicker({dateFormat: 'yy-mm-dd'}, $.datepicker.regional[ "it" ] );
                  });


            </script>      
                
        <?php
                //echo $this->Form->input('data_fine');
		echo $this->Form->input('note');
		echo $this->Form->input('segnalato_da');
		echo $this->Form->input('Categoria', array('multiple' => 'checkbox'));
	?>
<?php echo $this->Form->end(__('Submit', true));?>
</article>