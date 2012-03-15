<header>
    <hgroup><h1><?php __('Edit Evento'); ?></h1></hgroup>
<ul class="actions">
	<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Evento.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Evento.id'))); ?></li>
	<li><?php echo $this->Html->link(__('List Eventi', true), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('List Categorie', true), array('controller' => 'categorie', 'action' => 'index')); ?> </li>
</ul>
</header>
<article class="eventi form">
<?php echo $this->Form->create('Evento');?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('che_cosa');
                
//                echo $this->Form->input('data_inizio',array('type' => 'date'));
//                echo $this->Form->input('data_fine',array('type' => 'date'));
		echo $this->Form->input('note');
		echo $this->Form->input('segnalato_da');
		//echo $this->Form->input('Categoria', array('multiple' => 'checkbox'));
	?>
        <ul>
            <?php foreach ($this->data['Appuntamento'] as $appuntamento) : ?>
            <li>
                <?php echo $this->Html->link(__('Delete', true), array('controller' => 'appuntamenti', 'action' => 'delete', $appuntamento['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $appuntamento['id'])); ?>
                <strong><?php echo $this->Time->format('d-m-Y',$appuntamento['data_inizio']); ?></strong>
                <?php 
                //if($appuntamento['cosa'] != $evento['Evento']['che_cosa']) 
                    echo $appuntamento['cosa']; 
                ?> 

            </li>
            <?php endforeach; ?>
        </ul>
<?php echo $this->Form->end(__('Submit', true));?>
</article>