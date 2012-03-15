<header>
	<hgroup>
		<h1><?php  __('Evento');?></h1>
	</hgroup>
        <ul class="actions">
                        <li><?php echo $this->Html->link(__('Edit Evento', true), array('action' => 'edit', $evento['Evento']['id'])); ?> </li>
                        <li><?php echo $this->Html->link(__('Delete Evento', true), array('action' => 'delete', $evento['Evento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $evento['Evento']['id'])); ?> </li>
                        <li><?php echo $this->Html->link(__('List Eventi', true), array('action' => 'index')); ?> </li>
                        <li><?php echo $this->Html->link(__('New Evento', true), array('action' => 'add')); ?> </li>
                        <li><?php echo $this->Html->link(__('List Categorie', true), array('controller' => 'categorie', 'action' => 'index')); ?> </li>
        </ul>
</header>
<article class="eventi view" style="height:100%; min-height: 600px;">
    <div style="width:50%; float:right; margin:3px; padding:3px; border:1px solid lightgrey;">
        <ul>
        <?php foreach($edizioni as $edizione): ?>
            <li>
                <span style="height:12px; width:36px; margin-right:2px; background-color: #<?php echo $edizione ['CategorieEventi']['Categoria']['colore']?>"> &nbsp;&nbsp;
                </span>
                <?php if($edizione ['Edizione']['in_evidenza']) echo $this->Html->image('icn_audio.png', array('title' => 'in evidenza','alt' => 'in evidenza' )); ?>
                <strong><?php echo $edizione ['Edizione']['data_uscita']?></strong>
                <?php echo $edizione ['CategorieEventi']['Categoria']['categoria']; ?>                
            </li>        
        <?php endforeach; ?>
        </ul>    
        <?php 
             echo $this->Form->create('Edizione',array('url' => '/edizioni/add', 'class' => false));
             //echo '<div style="width:150px;">'; //float:left; 
             echo $this->Form->input('data_uscita', array('type' => 'text',  'label' => 'Data uscita (numero/puntata)'));                                     
             echo $this->Form->input('categorieeventi_id', array('type' => 'select', 'options' => $categorie_possibili, 'label' => 'Categorie possibili' ));
             echo $this->Form->input('in_evidenza');
             //echo '</div>';
             echo $this->Form->input('note', array('type' => 'textarea', 'label' => 'note'));
             echo $this->Form->end('Aggiungi');
        ?>
        <script>
        /*
         * CALENDARIETTO per data evento
         */

            $(function() {
                        $( "#EdizioneDataUscita" ).datepicker( {dateFormat: 'yy-mm-dd'}, $.datepicker.regional[ "it" ]  );
              });

        </script>
        
        <h4 style="margin-top:36px;">Informazioni</h4>
        <dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $evento['Evento']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Che Cosa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <h2>
			<?php echo $evento['Evento']['che_cosa']; ?>
			&nbsp;
                    </h2>
		</dd>
                
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Note'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Text->autoLink( $evento['Evento']['note']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Segnalato Da'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <strong>	<?php echo $evento['Evento']['segnalato_da']; ?>
			&nbsp;
                    </strong>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<strong><?php echo $evento['Evento']['created']; ?>
			&nbsp;
                        </strong>
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<strong><?php echo $evento['Evento']['modified']; ?>
			&nbsp;</strong>
		</dd>                
	</dl>
    </div>
	
		
        <h2 style="margin-left:10px;">
            <?php echo $evento['Evento']['che_cosa']; ?>
            &nbsp;
        </h2>
	
    
        
        <article class="related" style="width: 40%; float:left;">
	<header>
		<h2><?php __('Related Appuntamenti');?></h2>
        <!--		<ul>
			<li><?php echo $this->Html->link(__('New Appuntamento', true), array('controller' => 'appuntamenti', 'action' => 'add'), array('class' => 'add'));?> </li>
		</ul>-->
	</header>
	<?php if (!empty($evento['Appuntamento'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<thead>
	<tr>
		<th><?php __('Id'); ?></th>
		
		<th><?php __('Cosa'); ?></th>
		<th><?php __('Data Inizio'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($evento['Appuntamento'] as $appuntamento):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
        </thead>
		<tr<?php echo $class;?>>
			<td><?php echo $appuntamento['id'];?></td>
			<td><?php echo $appuntamento['cosa'];?></td>
                        <td><h2><?php echo $this->Time->format('d-m-Y', $appuntamento['data_inizio']);?></h2></td>
			
			<td class="actions">
				<?php //echo $this->Html->link(__('View', true), array('controller' => 'appuntamenti', 'action' => 'view', $appuntamento['id']), array('class' => 'view')); ?>
				<?php //echo $this->Html->link(__('Edit', true), array('controller' => 'appuntamenti', 'action' => 'edit', $appuntamento['id']), array('class' => 'edit')); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'appuntamenti', 'action' => 'delete', $appuntamento['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $appuntamento['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
     <article class="eventi form">
         <h3>Aggiungi nuova data</h3>
                                <?php echo $this->Form->create('Appuntamento');?>
                                <?php
                                        echo $this->Form->input('evento_id', array('type' => 'hidden', 'value' => $evento['Evento']['id']));
                                        echo $this->Form->input('cosa');
                                        echo $this->Form->input('data_inizio', array('type' => 'text'));
                                        //echo $this->Form->input('ora_inizio');
                                ?>
                                <script>
                                /*
                                 * CALENDARIETTO per data evento
                                 */

                                    $(function() {
                                                $( "AppuntamentoDataInizio" ).datepicker( {dateFormat: 'yy-mm-dd'}, $.datepicker.regional[ "it" ] );
                                      });


                                </script>
                                <?php echo $this->Form->submit();?>
                                </article>

        </article>
    
        <article class="related" style="clear:left; width: 40%; float:left;" >
	<header>
		<h2><?php __('Related Categorie');?></h2>
                
	</header>
	<?php if (!empty($evento['Categoria'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<thead>
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Categoria'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($evento['Categoria'] as $categoria):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
        </thead>
                   
		<tr<?php echo $class;?>>
			<td><?php echo $categoria['id'];?></td>
			<td>
                            <span style="height:12px; width:36px; margin-right:2px; background-color: #<?php echo $categoria['colore']?>"> &nbsp;&nbsp;
                            </span>
                        
                        <?php echo $categoria['categoria'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'categorie', 'action' => 'view', $categoria['id']), array('class' => 'view')); ?>
				<?php //echo $this->Html->link(__('Edit', true), array('controller' => 'categorie', 'action' => 'edit', $categoria['id']), array('class' => 'edit')); ?>
				<?php //echo $this->Html->link(__('Delete', true), array('controller' => 'categorie', 'action' => 'delete', $categoria['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $categoria['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
    <?php endif; ?>

    </article>
</article>


