<header>
	<hgroup>
		<h1><?php echo $this->Html->link('HOME', '/')?></h1>
		<h2><?php echo $this->Html->link('Esamina', '/eventi/prossimi')?></h2>
	</hgroup>
	<div>
		<p>Segnalazioni - Torna all'intranet</p>
		<?php echo $this->Html->link('Esci', 'http://192.168.2.202/intranet/index.php?mod=oggi', array('title' => 'Logout', 'class' => 'logout'))?>
	</div>
</header> 

<!--<form class="quick_search">
	<input type="text" value="Ricerca (non ancora attiva)" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
</form>-->
<hr/>
<h3>Visualizza Eventi</h3>
    <?php 
    $data_scelta = '';
    if($this->Session->check('data_scelta')) $data_scelta = '/'. $this->Session->read('data_scelta');
    ?>
<ul>
        <li class="icn_settings"><a href="/eventi/prossimi/all<?php echo $data_scelta; ?>">Prossimi (tutte le cateogire)</a></li>
<!--    ciclo foreach con categorie.. prossimi per nuova, per sito.. -->
    <?php foreach($menu_categorie as $categoria): ?>
    <li class="icn_tags">
        <span style="height:10px; width:10px; margin-left:2px; margin-right:4px; border: 1px solid white; background-color: #<?php echo $categoria['Categoria']['colore']?>">&nbsp;&nbsp;</span><a href="/eventi/prossimi/<?php echo $categoria['Categoria']['id']. $data_scelta;  ?>">
            <?php echo $categoria['Categoria']['categoria']; ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<h3>Gestisci Eventi</h3>
<ul>
	<li class="icn_new_article"><a href="/eventi/add">Nuovo Evento</a></li>
	<li class="icn_categories"><a href="/eventi">Lista eventi</a></li>
		
</ul>


<h3>Edizioni (numeri/puntate)</h3>
<ul>
	<li class="icn_video"><a href="/edizioni/index">Vedi i prossimi numeri</a></li>
	<?php 
        foreach($menu_categorie as $categoria): 
            if($categoria['Categoria']['ha_edizioni']):    
            
        ?>        
        <li class="icn_video">
        <span style="height:10px; width:10px; margin-left:2px; margin-right:4px; border: 1px solid white; background-color: #<?php echo $categoria['Categoria']['colore']?>">&nbsp;&nbsp;</span><a href="/edizioni/index/<?php echo $categoria['Categoria']['id'] //. $data_scelta;  ?>">
            <?php echo $categoria['Categoria']['categoria']; ?>
        </a>
        </li>
        <?php 
            endif;
        endforeach; 
        ?>
</ul>

<h3>Gestisci Categorie [media]</h3>
<ul>
	<li class="icn_new_article"><a href="/eventi/add">Nuova Categoria</a></li>
	<li class="icn_folder"><a href="/categorie">Categorie</a></li>
</ul>
<!--<h3>Utenti</h3>
<ul class="toggle">
	<li class="icn_add_user"><a href="/users/users/register">Nuovo utente</a></li>
	<li class="icn_view_users"><a href="/admin/users/users/index">Elenca utenti</a></li>
	<li class="icn_profile"><a href="/users/users/edit">Il tuo profilo</a></li>
</ul>-->


<footer>
	<hr />
        <p><strong>Copyright? &copy; <a href="http://stefanomanfredini.info">SM</a></strong></p>
	<p>Graphic Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
</footer>