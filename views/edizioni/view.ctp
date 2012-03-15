<header>
    <?php $edizione = $edizioni[0]; ?>
	<hgroup>
		<h1><?php  __('Edizione');?></h1>
	</hgroup>
	<ul class="actions">
		<li><?php echo $this->Html->link(__('Edit Edizione', true), array('action' => 'edit', $edizione['Edizione']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Edizione', true), array('action' => 'delete', $edizione['Edizione']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $edizione['Edizione']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Edizioni', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Edizione', true), array('action' => 'add')); ?> </li>
	</ul>
</header>
<article class="edizioni view">
    
	
    <div class="news-date" style="float:left;">
                        <?php 
                        $data_inizio = explode('-', $edizione['Edizione']['data_uscita']); 
                        $d = array_pop ($data_inizio); $m = array_pop ($data_inizio); $y = array_pop ($data_inizio); 
                        ?>
                        <span class="month"><?php echo $mesi[$m];  //date('m',strtotime($evento['Evento']['data_inizio'])); ?></span><br />
                        <span class="day"><?php echo $d; ?></span><br />
                        <span class="year"><?php echo $y; ?></span>
                        
    </div>
    <h2>
        <span style="height:26px; width:26px; margin: 0 2px 0 12px; background-color: #<?php echo $edizione['CategorieEventi']['Categoria']['colore']?>"> &nbsp;&nbsp;&nbsp;
        </span> 
        <?php echo $edizione['CategorieEventi']['Categoria']['categoria']; ?>                    
    </h2>
    
    <table style="clear:both;">
        <tr>
            <th>
                Id
            </th>
            <th>
                Note
            </th>
            <th>
                Appuntamento
            </th>

            <th class="actions"><?php __('Actions');?></th>
	</tr>
    <?php
//		echo $this->Batch->filter(array(
//			null,
//			'data_uscita',
//			'categorieeventi_id' => array('empty' => '-- None --'),
//			'note'
//		));
	$i = 0;
	foreach ($edizioni as $edizione):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
                
                
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $edizione['Edizione']['id']; ?>&nbsp;</td>
		
		<td>                   
                    <div><?php echo $edizione['Edizione']['note']; ?>&nbsp;</div>
                    <?php //echo $this->Html->link($edizione['CategorieEventi']['id'], array('controller' => 'categorie_eventi', 'action' => 'view', $edizione['CategorieEventi']['id'])); ?>
		</td>
		<td>
                    <h3>
                    <?php 
                    if($edizione['Edizione']['in_evidenza']) echo $this->Html->image('icn_audio.png', array('title' => 'in evidenza','alt' => 'in evidenza' )); 
                    ?>
                    <?php echo $edizione['CategorieEventi']['Evento']['che_cosa'] ?>
                    </h3>
                    <ul>
                        <?php foreach($edizione['CategorieEventi']['Evento']['Appuntamento'] as $appuntamento) : ?>
                        <li>
                            
                            <strong>
                            <?php echo $this->Time->format('d-m-Y', $appuntamento['data_inizio']); ?>
                            </strong>    
                            <?php echo $appuntamento['cosa']; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View', true), array('action' => 'view', $edizione['Edizione']['id']), array('class' => 'view')); ?>
			<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $edizione['Edizione']['id']), array('class' => 'edit')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $edizione['Edizione']['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $edizione['Edizione']['id'])); ?>
			<?php //echo $this->Batch->checkbox($edizione['Edizione']['id']); ?>
		</td>
	</tr>
	<?php         
       
        endforeach;
//		echo $this->Batch->batch(array(
//			null,
//			'data_uscita',
//			'categorieeventi_id' => array('empty' => '-- None --'),
//			'note'
//		));
        ?> 
        </table>
</article>
