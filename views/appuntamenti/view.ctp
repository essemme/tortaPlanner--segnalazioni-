<header>
	<hgroup>
		<h1><?php  __('Appuntamento');?></h1>
	</hgroup>
	<ul class="actions">
			<li><?php echo $this->Html->link(__('Edit Appuntamento', true), array('action' => 'edit', $appuntamento['Appuntamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Appuntamento', true), array('action' => 'delete', $appuntamento['Appuntamento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $appuntamento['Appuntamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Appuntamenti', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Appuntamento', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Eventi', true), array('controller' => 'eventi', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evento', true), array('controller' => 'eventi', 'action' => 'add'), array('class' => 'add')); ?> </li>
	</ul>
</header>
<article class="appuntamenti view">
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $appuntamento['Appuntamento']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Evento'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($appuntamento['Evento']['che_cosa'], array('controller' => 'eventi', 'action' => 'view', $appuntamento['Evento']['id']), array('class' => 'view')); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cosa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $appuntamento['Appuntamento']['cosa']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Data Inizio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $appuntamento['Appuntamento']['data_inizio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ora Inizio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $appuntamento['Appuntamento']['ora_inizio']; ?>
			&nbsp;
		</dd>
	</dl>
</article>
