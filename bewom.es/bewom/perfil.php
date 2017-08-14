<?php
include 'include/general/functions.php';
include 'include/general/cabecera.php';

$userInfo = getUser($_GET["params"]);

if(empty($userInfo->name)):
echo "<meta http-equiv='refresh' content='0; url=".WEB."404' />";
else:

if(!isValidSession()):
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
?>

<style>
	
#a {
	height: 40px;
	background-color: #CF3232;
/* 	border-bottom: 4px solid #333; */
}

#b {
	margin: 4px;
	float: left;
	width: 32px;
	height: 32px;
}

#c{
	height: 32px;
}
#d{
	float: left;
	font-size: 20px;
	font-weight: bold;
	letter-spacing: -2px;
	margin-top: 8px;
	color: #fff;
}
#e {
    float: right;
    font-size: 26px;
    font-weight: bold;
    letter-spacing: -2px;
    margin-top: 5px;
    margin-right: 10px;
    color: #FFF;
}
#f{
	background-color: #FFF;
	border-bottom: 4px solid #C3C3C3;
	padding: 4px;
}
</style>

<style>
td {
	background-color: #F9F9F9;
	padding: 4px;
	font-size: 14px;
	border-bottom: 2px solid #808080;
}
.iconforum {
    background-repeat: no-repeat;
    float: left;
    width: 32px;
    height: 32px;
    margin-right: 4px;
}
.titleForum {
    font-weight: bold;
}
table {
	width: 100%;
}

.text{
	width: 472px;
	overflow: hidden;
	height: 20px;
	padding: 8px;
}
.textShadow{
	position: absolute;
	margin-left: 8px;
	width: 464px;
	-webkit-box-shadow: inset 0px -43px 26px -40px rgba(0,0,0,1);
	-moz-box-shadow: inset 0px -43px 26px -40px rgba(0,0,0,1);
	box-shadow: inset 0px -43px 26px -40px rgba(0,0,0,1);
}
.imageAmigo{
	width: 24px;
	height: 24px;
	border: 4px solid;
	padding: 0px;
	float: left;
	box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.75) inset;
	margin-bottom: 3.5px;
	margin-left: 3.5px;
}
.textLeyendo {
	overflow: hidden;
	width: 480px;
	margin-left: 8px;
	border-bottom: 2px solid #C3C3C3;
}
.nameHover { 
	position: absolute;
	background-color: #333;
	margin-top: 28px;
	margin-left: 28px;
	padding: 4px;
	border-radius: 0px 6px 6px 6px;
	font-weight: bold;
	color: #FFF;
	box-shadow: 4px 4px 0px 0px rgba(105, 105, 105, 0.5);
}

.info_player {
    font-size: 16px;
    font-weight: bold;
    letter-spacing: -1px;
    color: #696969;
}
</style>

<div id="barebone">
	<div id="page">
		<div style="width: 100%; display: table-cell;">
			<div id="profile_imageProfile" class="<?php echo $userInfo->type;?>" style="background: url('https://minotar.net/helm/<?php echo $userInfo->name;?>/36') no-repeat scroll "></div>
			<h2 id="profile_nameProfile"><?php echo $userInfo->name;?></h2>
		</div>
		<hr class="<?php echo $userInfo->type."Ba";?>" style="margin-top: -4px;"><br>
		
		<div id="profileColumnLeft">
			<h2><center>Pokemons</center></h2>
			<hr>
			<?php 
			
			for ($i = 0; $i < 6; $i++) :
				
			$pokeName = $userInfo->pokemons[$i]->name;
			$shiny = $userInfo->pokemons[$i]->shiny;
			
			if(empty($pokeName)):
			?>
			<div style="background-color: #C3C3C3" id="a"></div>
			<?php
			else:
			?>
			<div style="<?php if($shiny){echo "background-color: #E0BD26;";}?>" id="a">
				<div id="b"><img id="c" src="../assets/<?php if($shiny){ echo "shiny";}?>pokemons/<?php echo getIntFromPokemon($pokeName);?>.png"></div>
				<a id="d"><?php echo $pokeName?></a>
				<a id="e"><?php echo $userInfo->pokemons[$i]->lvl;?></a>
			</div>
			<?php endif; endfor;?>
			<hr>
			
		</div>	
			
		<div id="profileColumnRight2">
			<h2><center>Información</center></h2>
			<hr>
			<div id="f" class="info_player">
				<a>Puntos: <?php echo $userInfo->points;?></a><br>
				<a>Tiempo jugado: <?php echo minutesToTime($userInfo->timePlaying);?></a><br>
				<a>Última conexión: <?php $f = $userInfo->lastLogin; if($f == "0000-00-00 00:00:00"){ echo "N/A"; }else{ echo getDateTime($f);}?></a> 
			</div>
			<?php if(!empty($userInfo->firma)):?>
			<h2><center>Firma</center></h2>
			<hr>
			<div id="f"><?php echo bb_parse_firma($userInfo->firma);?></div>
			<?php endif;?>
			<!-- END Posts -->
			<?php if(!empty($userInfo->amigo)):?>
			<h2><center>Amigos</center></h2>
			<hr>
			<div id="insideDiv" style="display: table-cell;">
			<?php foreach ($userInfo->amigo as $amigo):?>
				<a href="/perfil/<?php echo getUser($amigo->uuid)->name;?>" >
					<div id="imageAmigo_<?php echo getUser($amigo->uuid)->name;?>" class="imageAmigo <?php echo getUser($amigo->uuid)->type;?>" style="background: url('https://minotar.net/helm/<?php echo getUser($amigo->uuid)->name;?>/24') no-repeat scroll ">
					<div id="hover_<?php echo getUser($amigo->uuid)->name;?>" class="nameHover" style="display: none;"><?php echo getUser($amigo->uuid)->name;?></div>
					</div>
				</a>
			<?php endforeach;?>
			<script>
			<?php foreach ($userInfo->amigo as $amigo1):?>
			$("#imageAmigo_<?php echo getUser($amigo1->uuid)->name;?>").hover( 
				function() {
					$("#hover_<?php echo getUser($amigo1->uuid)->name;?>").show();
				}, function() {
					$("#hover_<?php echo getUser($amigo1->uuid)->name;?>").hide();
			});
			<?php endforeach;?>
			</script>
			</div>
			<?php endif;?>
			
			<?php if(count($userInfo->medallas) != 0):?>
			<h2><center>Medallas</center></h2>
			<hr>
			<div id="insideDiv" style="display: table-cell;">
			<?php for ($i = 0; $i < count($userInfo->medallas); $i++):?>
				<div id="M_<?php echo $userInfo->medallas[$i]; ?>" style="cursor: pointer; height: 32px; width: 32px;background: url('/assets/medallas/<?php echo $userInfo->medallas[$i]; ?>.png') no-repeat scroll 0% 0% / 100% 100%;;float: left;">
					<div id="hoverM_<?php echo $userInfo->medallas[$i]; ?>" class="nameHover" style="margin-top: 32px;margin-left: 32px;display: none;"><?php echo $userInfo->medallasDef[$i]; ?></div>
				</div>
			<?php endfor;?>
			</div>
			<script>
			<?php for ($i = 0; $i < count($userInfo->medallas); $i++):?>
			$("#M_<?php echo $userInfo->medallas[$i];?>").hover( 
				function() {
					$("#hoverM_<?php echo $userInfo->medallas[$i];?>").show();
				}, function() {
					$("#hoverM_<?php echo $userInfo->medallas[$i];?>").hide();
			});
			<?php endfor;?>
			</script>
			<?php endif;?>
			
		</div>
	</div>
</div>

<?php 
	endif;
endif;
?>
<?php include 'include/general/footer.php';?>