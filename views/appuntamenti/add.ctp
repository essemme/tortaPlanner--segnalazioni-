<header>
	<hgroup>
		<h1><?php __('Add Appuntamento'); ?></h1>
	</hgroup>
	<ul class="actions">
			<li><?php echo $this->Html->link(__('List Appuntamenti', true), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Eventi', true), array('controller' => 'eventi', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evento', true), array('controller' => 'eventi', 'action' => 'add')); ?> </li>
	</ul>
</header>
<article class="appuntamenti form">
<?php echo $this->Form->create('Appuntamento');?>
	<?php
		echo $this->Form->input('evento_id');
		echo $this->Form->input('cosa');
		echo $this->Form->input('data_inizio');
		//echo $this->Form->input('ora_inizio');
	?>
	<footer>
		<?php echo $this->Form->submit();?>
	</footer>
<?php echo $this->Form->end();?>
</article>