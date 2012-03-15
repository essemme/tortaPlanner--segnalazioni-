<header>
    <hgroup><h1><?php __('Eventi');?></h1></hgroup>
<ul class="actions">
	<li><?php echo $this->Html->link(__('New Evento', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categorie', true), array('controller' => 'categorie', 'action' => 'index')); ?> </li>
</ul>
</header>
<article class="eventi index">
	<header>
		<div class="paging">
			<?php echo $this->Paginator->prev('&laquo; ' . __('previous', true), array('escape' => false), null, array('escape' => false, 'class'=>'disabled'));?>
			| <?php echo $this->Paginator->numbers();?>
 |
			<?php echo $this->Paginator->next(__('next', true) . ' &raquo;', array('escape' => false), null, array('escape' => false, 'class' => 'disabled'));?>
		</div>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));
		?>		</p>
	</header>
	
    <table cellpadding="0" cellspacing="0">
        <?php echo $this->Batch->create('Evento')?>	
	<tr>
			<th>n° <?php echo $this->Paginator->sort('id');?>
                            <?php //echo $this->Paginator->sort('data_inizio');?>
                            <?php //echo $this->Paginator->sort('data_fine');?>
                            
                        </th>
			<th><?php echo $this->Paginator->sort('che_cosa');?></th>
			<th><?php echo $this->Paginator->sort('note');?></th>
			
<!--                        <th>
                        <?php //echo $this->Paginator->sort('segnalato_da');?>
                        il <?php //echo $this->Paginator->sort('created');?>
                        <br /><?php //echo $this->Paginator->sort('modified');?>
                        </th>-->
			
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
        echo $this->Batch->filter(array('id' => null,
		'che_cosa',
		'note',
		//'segnalato_da',
		));

        ?>
        <tfoot>
                <?php echo $this->Batch->batch(array('id' => null,
		'che_cosa',
		'note',
		//'segnalato_da',
		)); ?>
        </tfoot>	
        <?php echo $this->Batch->end()?>
        <?php 
	$i = 0;
        
	foreach ($eventi as $evento):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
        
        
	<tr<?php echo $class;?>>
		<td>
                    <strong>n°</strong> <?php echo $evento['Evento']['id']; ?>&nbsp; <br />
                    
                    <ul>
                    <?php foreach ( $evento['Categoria'] as $categoria): ?>
                        <li>
                            <span style="height:12px; width:16px; margin-right:2px; background-color: #<?php echo $categoria['colore']?>"> &nbsp;&nbsp;
                            </span> <?php echo $categoria['categoria']; ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php //echo $this->Time->format('d-m-Y',$evento['Evento']['data_inizio']); ?><br />
                &nbsp;<?php //echo $this->Time->format('d-m-Y',$evento['Evento']['data_fine']); ?>
                 </td>
		<td>
                    <h3><?php echo $evento['Evento']['che_cosa']; ?></h3>
                    <ul>
                        <?php foreach ($evento['Appuntamento'] as $appuntamento) : ?>
                        <li>
                            <?php echo $this->Html->link(__('Delete', true), array('controller' => 'appuntamenti', 'action' => 'delete', $appuntamento['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $appuntamento['id'])); ?>
			    <strong><?php echo $this->Time->format('d-m-Y',$appuntamento['data_inizio']); ?></strong>
                            <?php 
                            if($appuntamento['cosa'] != $evento['Evento']['che_cosa']) 
                                echo $appuntamento['cosa'];
                            ?> 
                            
                        </li>
                        <?php endforeach; ?>
                    </ul>
                                               
                    <h4>Aggiungi data in questo ciclo >></h4><div class="toggle">
                                                                
                                <article class="eventi form">
                                <?php echo $this->Form->create('Appuntamento', array('url' => '/appuntamenti/add', 'id' => 'form_'.$evento['Evento']['id'] ));?>
                                <?php
                                        echo $this->Form->input('Appuntamento.evento_id', array('type' => 'hidden', 'value' => $evento['Evento']['id']));
                                        echo $this->Form->input('Appuntamento.cosa');
                                        echo $this->Form->input('Appuntamento.data_inizio', array('type' => 'text', 'class' => 'data'.$evento['Evento']['id']));
                                        //echo $this->Form->input('ora_inizio');
                                ?>
                                <script>
                                /*
                                 * CALENDARIETTO per data evento
                                 */

                                    $(function() {
                                       $( "AppuntamentoDataInizio.data<?php echo $evento['Evento']['id'];?>" ).datepicker({dateFormat: 'yy-mm-dd'}, $.datepicker.regional[ "it" ] );
                                      });


                                </script>
                                <?php echo $this->Form->end('Aggiungi');?>
                                </article>
                            </div>
                </td>
		<td><?php echo $this->Text->autoLink( $this->Text->truncate($evento['Evento']['note']) ); ?>&nbsp;</td>
<!--		<td>
                    <?php //echo $evento['Evento']['segnalato_da']; ?><br />
                    <strong>il:</strong> <?php //echo $this->Time->format('d-m-Y H:i',$evento['Evento']['created']); ?><br />
                    <strong>modif. il:</strong><br /> <?php //echo $this->Time->format('d-m-Y H:i',$evento['Evento']['modified']); ?>
                </td>-->
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $evento['Evento']['id']), array('class' => 'view')); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $evento['Evento']['id']), array('class' => 'edit')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $evento['Evento']['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $evento['Evento']['id'])); ?>
                        <?php echo $this->Batch->checkbox($evento['Evento']['id']); ?>
                </td>
	</tr>
<?php endforeach; ?>

        </table>
		
	<footer>
		<div class="paging">
			<?php echo $this->Paginator->prev('&laquo; ' . __('previous', true), array('escape' => false), null, array('escape' => false, 'class'=>'disabled'));?>
			| <?php echo $this->Paginator->numbers();?>
 |
			<?php echo $this->Paginator->next(__('next', true) . ' &raquo;', array('escape' => false), null, array('escape' => false, 'class' => 'disabled'));?>
		</div>
	</footer>
</article>

