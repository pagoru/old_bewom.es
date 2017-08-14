<!-- // Top Jugadores pgdk (bewom.es) -->
<?php 

$users = getTopUsers();

?>
<style>
	<?php include "css/style_top.css";?>
</style>
<div style="display: table-cell;">
	<h2><center><a href="/torneos/top">Top jugadores</a></center></h2>
	<hr style="margin-bottom: 4px;">
	
	<a href="/perfil/<?php echo $users[0]->name?>" id="top_oro">
		<div class="<?php echo $users[0]->type?>" id="top_oro_image" style="background: url('https://minotar.net/helm/<?php echo $users[0]->name?>/36') no-repeat scroll "></div>
		<div id="top_name">
			<?php echo "1. ".$users[0]->name?><br>
			<div id="top_oro_poke" style="background: url('/assets/<?php if($shiny){ echo "shiny";}?>pokemons/<?php echo getIntFromPokemon($users[0]->pokemons[0]->name)?>.png') no-repeat scroll "></div>
			<div id="top_pokename" style="margin-top: 8px;"><?php echo $users[0]->pokemons[0]->name?> <?php echo $users[0]->pokemons[0]->lvl?></div>
		</div>
		<div id="top_oro_puntos"><?php echo $users[0]->points?></div>
	</a>
	
	<a href="/perfil/<?php echo $users[1]->name?>" id="top_plata">
		<div class="<?php echo $users[1]->type?>" id="top_plata_image" style="background: url('https://minotar.net/helm/<?php echo $users[1]->name?>/32') no-repeat scroll "></div>
		<div id="top_name">
			<?php echo "2. ".$users[1]->name?><br>
			<div id="top_plata_poke" style="background: url('/assets/<?php if($shiny){ echo "shiny";}?>pokemons/<?php echo getIntFromPokemon($users[1]->pokemons[0]->name)?>.png') no-repeat scroll "></div>
			<div id="top_pokename" style="margin-top: 4px;"><?php echo $users[1]->pokemons[0]->name?> <?php echo $users[1]->pokemons[0]->lvl?></div>
		</div>
		<div id="top_plata_puntos"><?php echo $users[1]->points?></div>
	</a>
	
	<a href="/perfil/<?php echo $users[2]->name?>" id="top_bronce">
		<div class="<?php echo $users[2]->type?>" id="top_bronce_image" style="background: url('https://minotar.net/helm/<?php echo $users[2]->name?>/28') no-repeat scroll "></div>
		<div id="top_name">
			<?php echo "3. ".$users[2]->name?><br>
			<div id="top_poke" style="background: url('/assets/<?php if($shiny){ echo "shiny";}?>pokemons/<?php echo getIntFromPokemon($users[2]->pokemons[0]->name)?>.png') no-repeat scroll "></div>
			<div id="top_pokename"><?php echo $users[2]->pokemons[0]->name?><?php echo $users[2]->pokemons[0]->lvl?></div>
		</div>
		<div id="top_bronce_puntos"><?php echo $users[2]->points?></div>
	</a>
	
	<?php 
	for ($i = 3; $i < 10; $i++):
	?>
	
	<a href="/perfil/<?php echo $users[$i]->name?>"  id="top">
		<div id="top_name">
			<?php echo ($i+1).". ".$users[$i]->name?><br>
		</div>
		<div id="top_puntos"><?php echo $users[$i]->points?></div>
	</a>
	
	<?php endfor;?>
	
</div>