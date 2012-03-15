<header>
	<hgroup>
		<h1><?php __('Edizioni');?></h1>
	</hgroup>
	<ul class="actions">
		<li><?php echo $this->Html->link(__('New Edizione', true), array('action' => 'add')); ?></li>
		</ul>
</header>
<article class="edizioni index">
	<header>
		<h3>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));
		?>
                </h3>
		<div class="paging">
			<?php echo $this->Paginator->prev('&laquo; ' . __('previous', true), array('escape' => false), null, array('escape' => false, 'class'=>'disabled'));?>
			<?php echo $this->Paginator->numbers();?>
			<?php echo $this->Paginator->next(__('next', true) . ' &raquo;', array('escape' => false), null, array('escape' => false, 'class' => 'disabled'));?>
		</div>
	</header>
	<?php //echo $this->Batch->create('Edizione')?>	
        <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('data_uscita');?></th>
			<th>Categoria <?php //echo $this->Paginator->sort('categorieeventi_id', array('label' => 'Categoria'));?></th>
			<th>Articolo / Evento<?php // echo $this->Paginator->sort('note');?></th>
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
                
                $changed = false;
                if( ($data_vecchia != $edizione['Edizione']['data_uscita']) || ($categoria_vecchia != $edizione['CategorieEventi']['categoria_id'])) {
                    $changed = true;
                } 
                
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $edizione['Edizione']['id']; ?>&nbsp;</td>
		<td>
                    <?php if($changed) : ?>
<!--                    <h2><?php //echo $this->Time->format('d-m-Y', $edizione['Edizione']['data_uscita'] ); ?></h2>
                    -->
                    <div class="news-date">
                        <?php 
                        $data_inizio = explode('-', $edizione['Edizione']['data_uscita']); 
                        $d = array_pop ($data_inizio); $m = array_pop ($data_inizio); $y = array_pop ($data_inizio); 
                        ?>
                        <span class="month"><?php echo $mesi[$m];  //date('m',strtotime($evento['Evento']['data_inizio'])); ?></span><br />
                        <span class="day"><?php echo $d; ?></span><br />
                        <span class="year"><?php echo $y; ?></span>
                        
                    </div>
                    
                    <?php endif; ?>
                </td>
		<td>
                    <?php if($changed) : ?>
                    <h2>
                        <span style="height:20px; width:20px; margin: 0 2px 0 12px; background-color: #<?php echo $edizione['CategorieEventi']['Categoria']['colore']?>"> &nbsp;&nbsp;&nbsp;
                        </span> 
                    <?php echo $edizione['CategorieEventi']['Categoria']['categoria']; ?>
                    </h2>
                    
                    <?php endif; ?>
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
			<?php echo $this->Html->link(__('View', true), array('action' => 'view',$edizione['CategorieEventi']['categoria_id'], $edizione['Edizione']['data_uscita']), array('class' => 'view')); ?>
			<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $edizione['Edizione']['id']), array('class' => 'edit')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $edizione['Edizione']['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $edizione['Edizione']['id'])); ?>
			<?php //echo $this->Batch->checkbox($edizione['Edizione']['id']); ?>
		</td>
	</tr>
	<?php         
        $data_vecchia = $edizione['Edizione']['data_uscita'];
        $categoria_vecchia = $edizione['CategorieEventi']['categoria_id'];
        //debug($categoria_vecchia);
        endforeach;
//		echo $this->Batch->batch(array(
//			null,
//			'data_uscita',
//			'categorieeventi_id' => array('empty' => '-- None --'),
//			'note'
//		));
        ?> 
	</table>
	<?php //echo $this->Batch->end()?> 
	<footer>
		<div class="paging">
			<?php echo $this->Paginator->prev('&laquo; ' . __('previous', true), array('escape' => false), null, array('escape' => false, 'class'=>'disabled'));?>
			| <?php echo $this->Paginator->numbers();?> |
			<?php echo $this->Paginator->next(__('next', true) . ' &raquo;', array('escape' => false), null, array('escape' => false, 'class' => 'disabled'));?>
		</div>
	</footer>
</article>
