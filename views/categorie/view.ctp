<header><h1><?php  __('Categoria');?></h1>
<ul class="actions">
		<li><?php echo $this->Html->link(__('Edit Categoria', true), array('action' => 'edit', $categoria['Categoria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Categoria', true), array('action' => 'delete', $categoria['Categoria']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $categoria['Categoria']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categorie', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categoria', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Eventi', true), array('controller' => 'eventi', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evento', true), array('controller' => 'eventi', 'action' => 'add'), array('class' => 'add')); ?> </li>
</ul>
</header>
<article class="categorie view">
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categoria'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
                    <div style="float:left; height:22px; width:22px; margin-right:4px; background-color: #<?php echo $categoria['Categoria']['colore']?>">
                    </div>
                    <?php echo $categoria['Categoria']['categoria']; ?>		
		</dd>
	</dl>
</article>
<article class="related">
	<header>
		<h2><?php __('Related Eventi');?></h2>
		<ul>
			<li><?php echo $this->Html->link(__('New Evento', true), array('controller' => 'eventi', 'action' => 'add'), array('class' => 'add'));?> </li>
		</ul>
	</header>
	<?php if (!empty($categoria['Evento'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<thead>
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Che Cosa'); ?></th>
		<th><?php __('Note'); ?></th>
		<th><?php __('Segnalato Da'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($categoria['Evento'] as $evento):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
</thead>
		<tr<?php echo $class;?>>
			<td><?php echo $evento['id'];?></td>
			<td><?php echo $evento['che_cosa'];?></td>
			<td><?php echo $evento['note'];?></td>
			<td><?php echo $evento['segnalato_da'];?></td>
			<td><?php echo $evento['created'];?></td>
			<td><?php echo $evento['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'eventi', 'action' => 'view', $evento['id']), array('class' => 'view')); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'eventi', 'action' => 'edit', $evento['id']), array('class' => 'edit')); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'eventi', 'action' => 'delete', $evento['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $evento['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</article>
