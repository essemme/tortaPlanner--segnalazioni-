<header>
	<hgroup>
		<h1><?php __('Add Edizione'); ?></h1>
	</hgroup>
	<ul class="actions">
			<li><?php echo $this->Html->link(__('List Edizioni', true), array('action' => 'index'));?></li>
	</ul>
</header>
<article class="edizioni form">
<?php echo $this->Form->create('Edizione');?>
	<?php
		echo $this->Form->input('data_uscita');
		echo $this->Form->input('categorieeventi_id');
		echo $this->Form->input('note');
	?>
	<footer>
		<?php echo $this->Form->submit();?>
	</footer>
<?php echo $this->Form->end();?>
</article>