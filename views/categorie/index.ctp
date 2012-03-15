<header><h2><?php __('Categorie');?></h2>
<ul class="actions">
	<li><?php echo $this->Html->link(__('New Categoria', true), array('action' => 'add')); ?></li>
	<li><?php echo $this->Html->link(__('List Eventi', true), array('controller' => 'eventi', 'action' => 'index')); ?> </li>
	<li><?php echo $this->Html->link(__('New Evento', true), array('controller' => 'eventi', 'action' => 'add')); ?> </li>
</ul>
</header>
<article class="categorie index">
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
	<?php echo $this->Batch->create('Evento')?>	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('categoria');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
echo $this->Batch->filter(array('id',
		'categoria'));

	$i = 0;
	foreach ($categorie as $categoria):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
        
        
	<tr<?php echo $class;?>>
		<td><?php echo $categoria['Categoria']['id']; ?>&nbsp;</td>
		<td>
                    <div style="float:left; height:22px; width:22px; margin-right:4px; background-color: #<?php echo $categoria['Categoria']['colore']?>">
                    </div>
                    <?php echo $categoria['Categoria']['categoria']; ?>&nbsp;
                </td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $categoria['Categoria']['id']), array('class' => 'view')); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $categoria['Categoria']['id']), array('class' => 'edit')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $categoria['Categoria']['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $categoria['Categoria']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
<tfoot><?php echo $this->Batch->batch(array('id',
		'categoria')); ?></tfoot>	</table>
		<?php echo $this->Batch->end()?>	
	<footer>
		<div class="paging">
			<?php echo $this->Paginator->prev('&laquo; ' . __('previous', true), array('escape' => false), null, array('escape' => false, 'class'=>'disabled'));?>
			| <?php echo $this->Paginator->numbers();?>
 |
			<?php echo $this->Paginator->next(__('next', true) . ' &raquo;', array('escape' => false), null, array('escape' => false, 'class' => 'disabled'));?>
		</div>
	</footer>
</article>