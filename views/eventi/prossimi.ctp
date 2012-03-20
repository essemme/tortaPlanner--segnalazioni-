<header>
    <hgroup><h1><?php __('Eventi');?></h1></hgroup>
<ul class="actions">
	<li><?php echo $this->Html->link(__('New Evento', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categorie', true), array('controller' => 'categorie', 'action' => 'index')); ?> </li>
</ul>
</header>
<article class="eventi index">
	<header>
            <div class="paging">
                <p>Prossimi appuntamenti</p>	<p></p>	
           </div>
	</header>
	<table cellpadding="0" cellspacing="0">
        <tr>
            <th colspan="3">
                <?php 
                echo $this->Form->create('Evento', array('url' => '/eventi/prossimi/'.$this->params['pass'][0]));
                echo $this->Form->input('data',array('label' => 'a partire dal giorno ', 'value' => $data));
                echo $this->Form->input('categoria',array('type' => 'hidden', 'value' => $categoria_id));
                echo $this->Form->end('Esamina');
                ?>
                <script>
                /*
                 * CALENDARIETTO per data evento
                 */

                    $(function() {
                                $( "#EventoData" ).datepicker( {dateFormat: 'yy-mm-dd'}, $.datepicker.regional[ "it" ]  );
                      });


                </script>
            </th>            
        </tr>   
        <?php if(isset($categoria_scelta)): ?>
        <tr>
            <th colspan="3">
            <h2>
                <span style="height:20px; width:20px; margin: 0 2px 0 12px; background-color: #<?php echo $categoria_colore; ?>"> &nbsp;&nbsp;
                </span>
                <?php 
                       echo  $categoria_scelta;
                ?>
            </h2>
            </th>
            
        </tr>  
        <?php endif; ?>
	<tr>
			<th>
                            Data
                        </th>
                        <th>
                            Appuntamento
                        </th>
			
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php

	$i = 0;
	foreach ($appuntamenti as $evento):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td style="width:100px;">                   
<!--                <h1><?php //echo $this->Time->format('d-m-Y',$evento['Appuntamento']['data_inizio']); ?></h1>-->
                    <a name="<?php echo $evento['Appuntamento']['id']; ?>"> </a>
                    <div class="news-date">
                        <?php 
                        $data_inizio = explode('-', $evento['Appuntamento']['data_inizio']); 
                        $d = array_pop ($data_inizio); $m = array_pop ($data_inizio); $y = array_pop ($data_inizio); 
                        ?>
                        <span class="month"><?php echo $mesi[$m];  //date('m',strtotime($evento['Evento']['data_inizio'])); ?></span><br />
                        <span class="day"><?php echo $d; ?></span><br />
                        <span class="year"><?php echo $y; ?></span>                        
                    </div>                    
                </td>
		<td>
                    <div>
                            <strong>
                            <?php if($evento['Appuntamento']['tra_quanti_giorni'] > 1 ): ?>
                            <h4>Tra <?php echo  $evento['Appuntamento']['tra_quanti_giorni']; ?> giorni </h4>
                            <?php endif; ?>
                            <?php if($evento['Appuntamento']['tra_quanti_giorni'] == 0): ?>
                            <h4>Oggi</h4>
                            <?php endif; ?>
                            <?php if($evento['Appuntamento']['tra_quanti_giorni'] == 1): ?>
                            <h4>Domani</h4>
                            <?php endif; ?>
                            <?php if($evento['Appuntamento']['tra_quanti_giorni'] < 0 ): ?>
                            <h4>Scaduto da <?php echo abs($evento['Appuntamento']['tra_quanti_giorni']); ?> giorni</h4>
                            <?php endif; ?>                            
                            </strong>
                    </div>    
                    <?php 
                        if (empty($evento['Appuntamento']['cosa'])) $evento['Appuntamento']['cosa'] = $evento['Evento']['che_cosa'];
                                      
                    ?>
                    <h2>
                        <?php echo $evento['Appuntamento']['cosa']; ?>                        
                    </h2>
                    <?php if($evento['Appuntamento']['cosa'] != $evento['Evento']['che_cosa']): ?>                    
                    <h3>ciclo: <?php echo $evento['Evento']['che_cosa']; ?></h3>
                    <?php endif; ?>
                    
                    
                    <table class="toggle">
                        <tr>
                        <?php                         
                        foreach($evento['Evento']['Categoria'] as $categoria): ?>
                            <th style="border-left: 1px dashed lightgrey; border-right: 1px dashed lightgrey;">
                            <?php echo $this->Html->link( $this->Html->image(
                                        'icn_trash.png', 
                                        array('alt' => 'Rimuovi legame', 'title' => 'Rimuovi legame')
                                        ),
                                        array('controller' => 'categorie_eventi', 'action' => 'delete', $categoria['CategorieEventi']['id'], $evento['Appuntamento']['id']),
                                        array('escape' => false),
                                        'Sicuro di voler togliere la relazione tra l\'evento e la categoria?'
                                    ) 
                            ?>
                            
                            <span style="height:12px; width:16px; margin: 0 2px 0 12px; background-color: #<?php echo $categoria['colore']?>"> &nbsp;&nbsp;
                            </span> <?php echo $categoria['categoria']; ?>
                            </th>
                        <?php endforeach; ?>
                        <tr>
                        <tr>
                            
                        <div id="singolo_evento_<?php echo $evento['Evento']['che_cosa']; ?>">
                            
                                                        
                        <?php 
                        
                        $categorie_presenti=array();
                        
                        foreach ($evento['Evento']['Categoria'] as $categoria): ?>
                            <td style="border-left: 1px dashed lightgrey; border-right: 1px dashed lightgrey;">                                
                            <?php 
                                //elenco numeri..
                                $catev_id = $categoria['CategorieEventi']['id'];
//                                App::import('Core','Set');
//                                $programmati = Set::extract("/{n}/Edizione/data_uscita[categorieeventi_id=$catev_id]", $numeri_presenti);
//                                //$programmati = Set::classicExtract( $numeri_presenti, "{n}.Edizione.data_uscita[categorieeventi_id=$catev_id]");
//                                debug($programmati);
                                
                                //foreach($programmati as $programmato) {
                                foreach ($numeri_presenti as $programmato) {
                                    if($programmato['Edizione']['categorieeventi_id'] == $catev_id ) {
                                        
                                        $data_formattata = $this->Time->format('d-m-Y', $programmato['Edizione']['data_uscita']);
                                        
                                        echo $this->Html->link( $this->Html->image(
                                        'icn_trash.png', 
                                        array('alt' => 'Rimuovi dal numero', 'title' => 'Rimuovi dal numero')
                                        ),
                                        array('controller' => 'edizioni', 'action' => 'delete', $programmato['Edizione']['id']  ),
                                        array('escape' => false),
                                        'Sicuro di voler togliere questo evento dall\'edizione del '. $data_formattata .'?'
                                        );
                                        echo "<strong>";
                                        echo $data_formattata."</strong>";                                
                                        if($programmato['Edizione']['in_evidenza']) echo $this->Html->image('icn_audio.png', array('title' => 'in evidenza','alt' => 'in evidenza' )); 
                                        echo "<br />";
                                    }
                                }
                            ?>
                            
                
                            
                            <?php if($categoria['ha_edizioni']): ?>
                                <h4>Nuovo Numero / edizione >></h4>
<!--                            <h4 class="trigger_form" id="toggle_<?php echo $categoria['CategorieEventi']['id']; ?>"> >> Aggiungi ad una uscita / puntata</h4>-->
                            <div class="toggle" id="hidden_<?php echo $categoria['CategorieEventi']['id']; ?>">
                                <?php 
                                     echo $this->Form->create('Edizione',array('url' => '/edizioni/add', 'class' => false));
                                     echo '<div style="width:150px;">'; //float:left; 
                                     echo $this->Form->input('data_uscita-'.$categoria['CategorieEventi']['id'].'-'.$evento['Appuntamento']['id'], array('type' => 'text', 'div' => false, 'class' => 'data_'.$categoria['CategorieEventi']['id'], 'label' => 'Data uscita (numero/puntata)'));                                     
                                     echo $this->Form->input('categorieeventi_id', array('type' => 'hidden', 'value' => $categoria['CategorieEventi']['id'] ));
                                     echo $this->Form->input('in_evidenza', array('div' => false));
                                     echo $this->Form->input('appuntamento_id', array('type' => 'hidden', 'value' => $evento['Appuntamento']['id']));
                                     
                                     echo '</div>';
                                     echo $this->Form->input('note', array('type' => 'text', 'div' => false, 'label' => 'note<br />'));
                                     echo $this->Form->end('Aggiungi', array( 'url'=> array('controller'=>'edizioni', 'action'=>'add') ));
//                                     echo $this->Js->submit('Aggiungi', 
//                                             array(
//                                                 //'url'=> array('controller'=>'edizioni', 'action'=>'add'), 
//                                                 'update' => '#singolo_evento_'.$evento['Evento']['id'])
//                                             );
                                ?>                                
                                <script>
                                /*
                                 * CALENDARIETTO per data evento
                                 */
                                
                                $(function() {
                                    $( "#EdizioneDataUscita-<?php echo $categoria['CategorieEventi']['id'].'-'.$evento['Appuntamento']['id']; ?>").datepicker({dateFormat: 'yy-mm-dd'}, $.datepicker.regional[ "it" ] );
                                });

                                </script>
                            </div>
                                
                            <?php endif; ?>
                            <?php $categorie_presenti[$categoria['id']] = $categoria['categoria']; ?>
                            </td>
                        <?php endforeach; ?>    
                            
                        </div>    
                        </tr>
                        <tfoot>
                            <tr>
                                <th colspan="<?php echo count($evento['Evento']['Categoria']); ?>">
                                <span  style="float: right; width:320px;">
                         <?php 
                        
                        $categorie_filtrate = array_diff($lista_categorie, $categorie_presenti);
                        
                         echo $this->Form->create('CategorieEventi',array('url' => '/categorie_eventi/add', 'class' => false, 'label' => false));
                         echo '<div style="float:left; width:150px;">';
                         echo $this->Form->input('categoria_id', array('type' => 'select','label' => false, 'div' => false, 'options' => $categorie_filtrate, 'style' => 'margin-top:6px;'));                                     
                         echo $this->Form->input('evento_id', array('type' => 'hidden', 'value' => $evento['Evento']['id'] ));
                         
                         echo $this->Form->input('appuntamento_id', array('type' => 'hidden', 'value' => $evento['Appuntamento']['id']));
                                     
                         echo '</div>';
                         echo $this->Form->end('Aggiungi legame');
                         ?>
                                </span>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                    <script>
//                    $(document).ready(function(){
//
//                            //Hide (Collapse) the toggle containers on load
//                            $(".hidden").hide(); 
//
//                            //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
//                            $("h4.trigger_form").click(function(){
//                                    $(this).next().slideToggle("slow"); //toggleClass("active").
//                                    return false; //Prevent the browser jump to the link anchor
//                            });
//
//                    });
//                    
                    </script>
                  
                    <p><?php echo $this->Text->truncate($evento['Evento']['note']); ?></p>
                    
<!--                    <p>
                    <?php //echo $evento['Evento']['segnalato_da']; ?> <strong>il:</strong> <?php //echo $this->Time->format('d-m-Y H:i',$evento['Evento']['created']); ?>&nbsp;<br />
                    <strong>ultima modifica il:</strong> <?php //echo $this->Time->format('d-m-Y H:i',$evento['Evento']['modified']); ?>&nbsp;
                    </p>-->
                </td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $evento['Evento']['id']), array('class' => 'view')); ?>
			<?php //echo $this->Html->link(__('Edit', true), array('action' => 'edit', $evento['Evento']['id']), array('class' => 'edit')); ?>
			<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $evento['Evento']['id']), array('class' => 'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $evento['Evento']['id'])); ?>
                      
                </td>
	</tr>
<?php endforeach; ?>
        <tfoot>

        </tfoot>
        </table>
			
	<footer>
		<div class="paging">
			
                </div>
	</footer>
</article>