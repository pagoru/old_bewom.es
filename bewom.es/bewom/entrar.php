<?php
include 'include/general/functions.php';
include 'include/general/cabecera.php';

if(isValidSession()):
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /'>";
else:

if(getLoginIpLasTimeInSeconds() > 300){
	clearLoginIpTries();
	echo "dasdsa";
}

$loginTry = true;
if(getLoginIpTries() == 5){
	$loginTry = false;
} else {
	if(isset($_POST["Login"])){
		$mail = $_POST["Log_Email"];
		$password = $_POST["Log_Password"];
		addIpLoginTry($mail);
		if(isset($mail)){
				
			$result = MysqlOpen ( "SELECT * FROM `users_info` WHERE `mail`='$mail'" );
			$row = mysql_fetch_array ( $result );
				
			if(!empty($row["mail"])){
	
				if(pass_verify($password, $row["password"])){
	
					if($row["active"]){
							
						$session = createCookieSession($mail);
						MysqlOpen("UPDATE `users_info` SET `session`='$session' WHERE `mail`='$mail'");
						clearLoginIpTries();
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=/login/".$session."/".$mail."'>";
							
					}
						
				}
	
			}
				
		}
	
	}	
}

?>
<style>
	<?php include "./css/style_normas.css";?>
</style>
<style>
.landscape {
    height: 400px;
	border: 4px solid #333;
	padding: 0px;
	margin: 0px -16px 8px;
}
.landImage{
	background-image: url("assets/portada/2015-10-17_20.10.19.png");
	background-size: 900px auto;
	background-position: 50% 50%;
	height: 100%;
	width: 100%;
}
#imageBottom{
	margin-top: -400px;
}
</style>
<body>

<div id="barebone">
	<div id="page">
		<?php include("include/general/landscape.php");?>			
		</script>
		<div id="columnLeft">		
			<h2><center>Entrar en la web</center></h2>
			<hr>
			<div id="insideDiv" style="display: table-cell;">
				<br>
				<?php if($loginTry):?>
				<form class="form" method="post">
					<input id="Log_Email" name="Log_Email" class="creacion_box" placeholder="Correo electrónico" size="34" autocomplete="off" type="text">
					<input id="Log_Password" name="Log_Password" class="creacion_box" placeholder="Contraseña" size="34" autocomplete="off" type="password" style="margin-bottom: 8px;">
					<button style="width: 200px;" id="Login" name="Login" class="creacion_boton" type="submit">Entrar</button>
					<div style="font-size: 12px; margin-top:8px; margin-right:16px; float:right;">Al entrar, aceptas el uso de <a style="font-weight:bold;"href="/cookies">cookies</a> en el sitio web.</div>
				</form>
				<?php else:?>
				<h3>Ehh... no puedes intentarlo tantas veces. Pruebalo de nuevo en unos minutos</h3>
				<?php endif;?>
			</div>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- bewom-portada 2 -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-4767860288794918"
			     data-ad-slot="9047377064"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
		<div id="columnRight">
			<h2><center>¿Como registrarse?</center></h2>
			<hr>
				<div id="insideDiv" style="background: url('../assets/info.png') repeat scroll 0% 0%;">
				<br><b>Primero:</b>
				<br>- Descarga la versión 1.8 de minecraft.
				<br>- Descarga la última versión de Java. <a href="http://adf.ly/1LkVJD" class="mod" target="_blank">//<b><i>link</i></b>//</a>
				<br>- Descarga el instalador: <a href="http://adf.ly/1LOsYn" class="mod" target="_blank">//<b><i><?php include 'instalador/config/version.cfg';?></i></b>//</a>
				
				<br><br><b>Segundo:</b>
				<br>- Sigue los pasos del instalador.
				
				<br><br><b>Tercer:</b>
				<br>- Entra en el servidor haciendo click en "Jugar".
				<br>- Entra en el servidor de teamspeak3 (si quieres): <a href="ts3server://ts.bewom.es" class="vip"><b><i>ts.bewom.es</i></b></a>.
				<br><br>
				</div>
			<hr>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- bewom-portada -->
			<ins class="adsbygoogle"
			     style="display:inline-block;width:300px;height:600px"
			     data-ad-client="ca-pub-4767860288794918"
			     data-ad-slot="6093910667"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
	</div>
</div>
</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>