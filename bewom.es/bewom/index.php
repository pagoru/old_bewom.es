<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

// error_reporting(E_ALL);
// ini_set("display_errors", true);

if(!isValidSession()):
echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
?>

<style>
	<?php include 'css/style_index.css';?>
</style>
<body>
<div id="barebone">
	<div id="page">	
	<?php include("include/general/landscape.php");?>
		<div id="a"></div>		
		<div class="players">
			<div class="onOf"></div>
			<div class="users">
			<?php $a = 0;?>
			<?php for ($i = -1; $i < 188; $i++):?>
				<div  id="user_<?php echo $i;?>" style="<?php if($i != -1): echo "display: none;"; endif;?>">
					<a id="a_<?php echo $i;?>" href="">
						<div id="imageAmigo_<?php echo $i?>" class="player_head" style="<?php if($i == -1): echo "background-image: url('https://minotar.net/helm/Herobrine/24')"; endif;?>">
							<div id="hover_<?php echo $i;?>" class="nameHover"><?php if($i == -1){echo "Herobrine";}?></div>
						</div>
						
					</a>
				</div>
			<?php endfor;?>
			</div>
		</div>
		<div id="columnLeft">
			<a target="_blank" href="http://twitter.com/bewom_es/">
				<div class="twitter">¡Siguenos en twitter!</div>
			</a>
			<a href="guia">
				<div class="guia">
					LA GUIA DE PIXELMON PARA BEWOM
				</div>
			</a>
			<h2><center>Últimas noticias</center></h2>
			<hr>
			<!-- Noticias -->
			<table>
			<tbody>
			<?php 
			$foro = getLastNoticias();
			foreach ($foro as $temas):
				$icon = "background-image: url(/assets/pokemons/".getIntFromPokemon($temas->icon).".png);";
				if(!$temas->open){
					$icon = "background-image: url(/assets/foro/cerrado.png), url(/assets/pokemons/".getIntFromPokemon($temas->icon).".png);";
				}
				?>
				<tr>
					<td>
						<div style="border-bottom: 2px solid #E7E7E7; padding-bottom: 4px;">
							<i class="iconForum" style="<?php echo $icon;?> background-repeat: no-repeat;"></i>
							<a class="titleForum" href="/foro/Noticias/<?php echo $temas->indice;?>/"><?php echo $temas->nombre;?></a>
							<div></div>
							<dfn><a href="/foro/Noticias/<?php echo $temas->indice;?>/"></a></dfn> 
							por <a class="<?php echo $temas->user->type;?>" style="font-weight: bold;" href="/perfil/<?php echo $temas->user->name; ?>"><?php echo $temas->user->name; ?></a>
							el día <?php echo getDateTime($temas->fecha); ?>
						</div>
						<a href="/foro/Noticias/<?php echo $temas->indice;?>/">
						<div class="textShadow text"> 
						</div>
						<div  class="text">
						<?php echo bb_parse($temas->texto, $temas->user->type);?>
						</div></a>
						<a href="/foro/Noticias/<?php echo $temas->indice;?>/"><div class="textLeyendo"><center> «« »»</center></div></a>
					</td>
				</tr>
				<?php
			endforeach;
			?>
			</tbody>
			</table>
			<!-- END Noticias -->
		</div> 
		
		<div id="columnRight">
			<div id="playersLast24">
				<?php for ($i = 0; $i < 24; $i++):?>
				<div class="separador">
					<div class="u" id="u<?php echo $i;?>"></div>
				</div>
				<?php endfor;?>
			</div>
			<div class="mcServers">
				<div class="mcStatus STred" id="statusLogin" >login</div>
				<div class="mcStatus SRred" id="statusSession" >sesiones</div>
				<div class="mcStatus STred" id="statusSkins" style="margin-right: 0px;">skins</div>
			</div>
			<?php include 'include/portada/top_jugadores.php';?>
			<?php include 'include/general/advert.php';?>
		</div>
		
	</div>
</div>

<script>
jQuery(window).load(function () {
	ping();
	setInterval(function(){
		ping();
	}, 50000);
	
	function ping(){
		$("#hover_-1").hide();
		$.get("test/players", function(data) {
			for (var i = 0; i < 188; i++) {
				$("#user_" + i).hide();
			}
			var players = data.split(",");
			if(players[0].length != 0){
				$.each( players, function(key, value){
					var player = value.split("?");
					$("#user_" + key).show();
					$("#imageAmigo_" + key).css("background-image", "url('https://minotar.net/helm/" + player[0] + "/24')");
					$("#imageAmigo_" + key).attr("class", "player_head " + player[1]);
					$("#a_" + key).attr("href", "/perfil/" + player[0]);
					$("#hover_" + key).html(player[0]);
				});
			}
			$.get("test/ping", function(data) {
				if(data == 1){
					$(".onOf" ).css("background-color", "#729636");
					if(players[0] != ""){
						$(".onOf" ).html(players.length);
					} else {
						$(".onOf" ).html("0");
					}
				} else {
					$(".onOf" ).css("background-color", "");
					$(".onOf" ).html("off");
				}
			});
		});

		$.get("test/usersGraph", function(data) {
			var dt = new Date();
			var hour = dt.getHours();
			
			var players = data.split(",");
			var h = hour;
			var masGrande = 1;
			for (var i = 23; i > -1; i--) {
				if(players[h] > parseInt(masGrande)){
					masGrande = players[h];
				}
				if(h == 0){
					h = 23;
				} else {
					h--;
				}
			}
			h = hour;
			var grandeMultiplicar = 50/masGrande;
			for (var i = 23; i > -1; i--) {
				var height = (players[h] * grandeMultiplicar);
				$("#u" + i).css("height", height + "px");
				$("#l" + i).text(h);
				if(h == 0){
					h = 23;
				} else {
					h--;
				}
			}
		});

		//mcstatus
	  	var mojangAPI = "http://status.mojang.com/check?service=";
	 	$.getJSON( mojangAPI + "authserver.mojang.com", function( json ) {
		  	$.each( json, function( key, val ) {
		  		$("#statusLogin").attr("class", "mcStatus ST" + val);
			});
		});
	 	$.getJSON( mojangAPI + "skins.minecraft.net", function( json ) {
		  	$.each( json, function( key, val ) {
		  		$("#statusSkins").attr("class", "mcStatus ST" + val);
			});
		});
	 	$.getJSON( mojangAPI + "sessionserver.mojang.com", function( json ) {
		  	$.each( json, function( key, val ) {
		  		$("#statusSession").attr("class", "mcStatus ST" + val);
			});
		});
		
	}
	<?php for ($j = -1; $j < 188; $j++):?>
	$("#hover_<?php echo $j;?>").hide();
	$("#imageAmigo_<?php echo $j;?>").hover( 
		function() {
			$("#hover_<?php echo $j;?>").show();
		}, function() {
			$("#hover_<?php echo $j;?>").hide();
	});
	<?php endfor;?>
	
});
</script>

</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>