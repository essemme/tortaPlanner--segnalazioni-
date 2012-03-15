<header>
	<hgroup>
		<h1><?php __('Appuntamenti');?></h1>
	</hgroup>
	<ul class="actions">
		<li><?php echo $this->Html->link(__('New Appuntamento', true), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List Eventi', true), array('controller' => 'eventi', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evento', true), array('controller' => 'eventi', 'action' => 'add')); ?> </li>
	</ul>
</header>
<article class="appuntamenti index">
	<header>
		<h3>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));
		?>		</h3>
		<div class="paging">
			<?php echo $this->Paginator->prev('&laquo; ' . __('previous', true), array('escape' => false), null, array('escape' => false, 'class'=>'disabled'));?>
			<?php echo $this->Paginator->numbers();?>
			<?php echo $this->Paginator->next(__('next', true) . ' &raquo;', array('escape' => false), null, array('escape' => false, 'class' => 'disabled'));?>
		</div>
	</header>
	<?php echo $this->Batch->create('Appuntamento')?>	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('evento_id');?></th>
			<th><?php echo $this->Paginator->sort('cosa');?></th>
			<th><?php echo $this->Paginator->sort('data_inizio');?></th>
			<th><?php echo $this->Paginator->sort('ora_inizio');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		echo $this->Batch->filter(array(
			null,
			'evento_id' => array('empty' => '-- None --'),
			'cosa',
			'data_inizio',
			'ora_inizio'
		));
	$i = 0;
	foreach ($appuntamenti as $appuntamento):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $appuntamento['Appuntamento']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($appuntamento['Evento']['che_cosa'], array('controller' => 'eventi', 'action' => 'view', $appuntamento['Evento']['id'])); ?>
		</td>
		<td><?php echo $appuntamento['Appuntamento']['cosa']; ?>&nbsp;</td>
		<td><?php echo $appuntamento['Appuntamento']['data_inizio']; ?>&nbsp;</td>
		<td><?php echo $appuntamento['Appuntamento']['ora_inizio']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $appuntamento['Appuntamento']['id']), array('class' => 'view')); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $appuntamento['Appuntamento']['id']), array('class' => 'edit')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $appuntamento['Appuntamento']['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $appuntamento['Appuntamento']['id'])); ?>
			<?php echo $this->Batch->checkbox($appuntamento['Appuntamento']['id']); ?>
		</td>
	</tr>
	<?php endforeach;
		echo $this->Batch->batch(array(
			null,
			'evento_id' => array('empty' => '-- None --'),
			'cosa',
			'data_inizio',
			'ora_inizio'
		));?> 
	</table>
	<?php echo $this->Batch->end()?> 
	<footer>
		<div class="paging">
			<?php echo $this->Paginator->prev('&laquo; ' . __('previous', true), array('escape' => false), null, array('escape' => false, 'class'=>'disabled'));?>
			| <?php echo $this->Paginator->numbers();?> |
			<?php echo $this->Paginator->next(__('next', true) . ' &raquo;', array('escape' => false), null, array('escape' => false, 'class' => 'disabled'));?>
		</div>
	</footer>
</article>
