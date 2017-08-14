<?php
// error_reporting(E_ALL);
// ini_set("display_errors", true);

header('Content-Type: text/html; charset=UTF-8');

if(getCurrentUser()->type == "admin"){
	if(isset($_POST["adminMode"])){
		if(getCurrentUser()->adminMode){
			setcookie("mode_admin", "0", 2147483647, "/");
		} else {
			setcookie("mode_admin", "1", 2147483647, "/");
		}
		$web = $_SERVER['REQUEST_URI'];
		echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";
	}
}

if(getCurrentUser()->ban->active == 1){
	if(empty(getTema("Reclamaciones", getCurrentUser()->uuid)->temas->indice)){
		$admin = getUser(getCurrentUser()->ban->admin);
		createNewTema("Magikarp", 
				getCurrentUser()->uuid, 
				getCurrentUser()->ban->admin, false, true, 
				"Te he baneado por ".getCurrentUser()->ban->motivo, 
				"Reclamaciones");
	}
	$temaForo = getTema("Reclamaciones", getCurrentUser()->uuid);
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if($actual_link != WEB."foro/Reclamaciones/".$temaForo->temas->indice){
		echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."foro/Reclamaciones/".$temaForo->temas->indice."'";
	}
}
echo $_POST["torneo"];
if(isset($_POST["torneo"])){
	inscribirTorneo();
}
?>

<head>
<?php if(isValidSession()):?>
	<?php if(getCurrentUser()->type == "miembro"):?>
	<!-- <script type="text/javascript">
		var adfly_id = 1923328;
		var adfly_advert = 'int';
		var adfly_protocol = 'http';
		var adfly_domain = 'adf.ly';
		var frequency_cap = '5';
		var frequency_delay = '5';
		var init_delay = '3';
		var popunder = true;
	</script>
	<script src="https://cdn.adf.ly/js/entry.js"></script>-->
	<?php endif;?>
<?php endif;?>
<!-- <script src="/js/fuckadblock.js"></script> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<!-- adfly -->
<script>
// 	$(function() {
// 		// Function called if AdBlock is detected
// 		function adBlockDetected() {
// 		    var e = document.body;
// 		    e.parentNode.removeChild(e);
// 			window.location = "/adblock/" + document.URL;
// 		}
	
// 		// Recommended audit because AdBlock lock the file 'fuckadblock.js' 
// 		// If the file is not called, the variable does not exist 'fuckAdBlock'
// 		// This means that AdBlock is present
// 		if(typeof fuckAdBlock === 'undefined') {
// 		    adBlockDetected();
// 		} else {
// 		    fuckAdBlock.onDetected(adBlockDetected);
// 		    fuckAdBlock.onNotDetected(adBlockNotDetected);
// 		    // and|or
// 		    fuckAdBlock.on(true, adBlockDetected);
// 		    fuckAdBlock.on(false, adBlockNotDetected);
// 		    // and|or
// 		    fuckAdBlock.on(true, adBlockDetected).onNotDetected(adBlockNotDetected);
// 		}
	
// 		// Change the options
// 		fuckAdBlock.setOptions('checkOnLoad', false);
// 		// and|or
// 		fuckAdBlock.setOptions({
// 		    checkOnLoad: false,
// 		    resetOnEnd: false
// 		});
// 	});
</script>
<!-- END adfly -->
<title>BEWOM PIXELMON</title>
<link rel="shortcut icon" href="/assets/icon.ico">
<style>
	<?php include "./css/style.css";?>
	<?php include "./css/style_profile.css";?>
	<?php include "./css/style_cabecera.css";?>

<?php if(getCurrentUser()->type == "admin"):?>
header a:hover{
	background-color: #333;
}

header, #header_info, #header_menu_profile{
	background-color: #<?php echo getCurrentUser()->cabecera;?>;
}

<?php elseif(getCurrentUser()->type == "vip"):?>
header a:hover{
	background-color: #333;
}

header, #header_info, #header_menu_profile{
	background-color: #<?php echo getCurrentUser()->cabecera;?>;
}
<?php else:?>
header a:hover{
	background-color: #333;
}

header, #header_info, #header_menu_profile{
	background-color: #CF3232;
}

<?php endif;?>
</style>
</head>

<header>
	<?php if(isValidSession()):?>
	<div id="header_logo"></div>
	<div id="header_select">
	<?php if(getCurrentUser()->ban->active != 1):?>
		<a id="Hportada" href="/">Portada</a> 
		<a id="Hvip" href="/donaciones">Donaciones</a> 
		<a id="Hforo" href="/foro/">Foro</a> 
		<a id="Htorneos" href="/torneos">Torneos</a>
	<?php else:?>
		<a id="Hportada">Estas baneado . . .</a> 
	<?php endif;?>
	</div>
	<div id="header_profile">
		<div id="header_menu_profile">
			<a id="mpn">
				<div id="profile_image" style="background: url('<?php echo "https://minotar.net/helm/".getCurrentUser()->name."/36";?>') no-repeat scroll "></div>
				<div style="font-size: 22px; float: right; padding: 14px 14px 14px 0px;"><?php echo getCurrentUser()->name;?></div>
			</a><br>
			<?php if(getCurrentUser()->ban->active != 1):?>
			<div id="mp" style="text-align: right; margin-right: 26px;">
				<a id="mpp" href="/perfil/<?php echo getCurrentUser()->name;?>">Perfil</a><br>
				<?php if(getCurrentUser()->type == "admin"):?>
					<a id="mpn2" href="/admin">Admin</a>
				<?php endif;?>
				<a id="mpc" href="/comandos" >Comandos</a><br>
				<a id="mpn2" href="/normas">Normas</a>
				<a id="mpa" href="/ajustes">Ajustes</a><br>
				<a id="mpd" href="/logout">Desconectarse</a>
			</div>
			<?php endif;?>
		</div>
	</div>
	<?php else:?>
	<center><div id="header_logo_simple"></div></center>
	<?php endif;?>
</header>

<?php if(getCurrentUser()->ban->active != 1):?>
<script>
<?php if(isValidSession()):?>
$('#mp').hide();
$('#header_menu_profile').attr( "style", "height: 66px; right: 0; display: table; position: absolute; width: 260px;" );

$("#header_menu_profile").hover(function() { 
	$('#mp').show();
	$('#header_menu_profile').attr( "style", "height: 66px; right: 0; display: table; position: absolute; width: 260px; border-bottom: 8px solid #333; padding-bottom: 0px;" );
}, function() {
	$('#mp').hide();
	$('#header_menu_profile').attr( "style", "height: 66px; right: 0; display: table; position: absolute; width: 260px;" );
});
<?php endif;?>
</script>
<?php endif;?>