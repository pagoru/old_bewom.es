<?php 
// error_reporting(E_ALL);
// ini_set("display_errors", true);
include 'include/general/functions.php';
include 'include/general/cabecera.php';

if(!isValidSession()):
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
if(getCurrentUser()->type != "admin"):
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."'>";
else:
?>
<style>
	.creacion_box {
	    border: 1px solid #989898;
	    padding: 8px;
	    width: 508px;
	    margin-bottom: 4px;
	}
	.creacion_boton{
		border: 1px solid rgb(152, 152, 152);
		height: 34px;
		width: 508px;
		margin-bottom: 4px;
	    background-color: #f0f0f0;
	}
	#send_textarea {
	    width: 508px;
		height: 128px;
		resize: none;
		padding: 8px;
		border: 1px solid #989898;
	}
	#columnLeft {
	    padding-right: 4px;
	    border-right: 2px solid #C3C3C3;
	    display: table-cell;
	    width: 248px;
	}
	#columnRight {
		display: table-cell;
	    width: 508px;
	    padding-left: 4px;
	    border-left: 2px solid #C3C3C3;
	}
	#firma {
	    background-color: #FFF;
		border-bottom: 4px solid #C3C3C3;
		border-top: 4px solid #C3C3C3;
		padding: 4px;
		margin-top: 4px;
	}
	.buttonOptions {
		border-bottom: 4px solid #333;
		background-color: #C3C3C3;
		margin-top: 4px;
		padding: 4px;
	}
	
	#grafica_trasera{
		background: #FFF url("/assets/background_grafica.png") repeat-x scroll 0px 4px;
		position: relative;
		padding: 4px 0px 4px 4px;
		height: 200px;
		width: 880px;
	}
	#grafica_consumo_ram{
		bottom: 4px;
		width: 20px;
		position: absolute;
		background-color: #2672B3;
		color: #fff;
		font-weight: bold;
		text-shadow: 0px 0px 2px rgb(0, 0, 0);
	}
	#grafica_consumo_cpu{
		bottom: 4px;
		width: 20px;
		margin-left: 20px;
		position: absolute;
		background-color: #CF3232;
		color: #fff;
		font-weight: bold;
		text-shadow: 0px 0px 2px rgb(0, 0, 0);
	}
	#grafica_consumo{
		float: left;
		width: 40px;
		height: 200px;
		margin-right: 4px;
	}
	
	#grafica_consumo_ram_h{
		bottom: 4px;
		width: 1px;
		position: absolute;
		background-color: rgba(38, 114, 179, 0.5);
	}
	#grafica_consumo_cpu_h{
		bottom: 4px;
		width: 1px;
		margin-left: 0px;
		position: absolute;
		background-color: rgba(207, 50, 50, 0.5);
	}
	#grafica_consumo_h {
	    float: left;
	    width: 1px;
	    height: 200px;
	    margin-right: 0px;
	}
</style>
<body>

<?php 
$uuid = getCurrentUser()->uuid;
if(isset($_POST["Send"])){
	
	$mail = $_POST["Send_mail"];
	$text = $_POST["Send_text"];
	
	if(!empty($mail) && !empty($text)){
		
		sendMail($mail, stringMailNew($text), "bewom.es");
		MysqlOpen("INSERT INTO `email_registro`(`uuid`, `sendEmail`, `all`, `text`) VALUES ('$uuid','$mail', false,'$text')");
		
	}

}
if(isset($_POST["SendATodos"])){

	$text = $_POST["Send_text"];

	if(!empty($text)){
		
		sendToAllMail(stringMailNew($text), "bewom.es");
		MysqlOpen("INSERT INTO `email_registro`(`uuid`, `all`, `text`) VALUES ('$uuid', true,'$text')");

	}

}
?>
<div id="barebone">
	<div id="page">
		<h2><center>Administración</center></h2>
		<hr><br>
		<div id="insideDiv">
			<center>
				<h3>Consumo servidor (20 minutos).</h3>
				<div id="grafica_trasera">
					<?php for ($i = 0; $i < 20; $i++):?>
					<div id="grafica_consumo">
						<div id="grafica_consumo_ram" class="ram_<?php echo $i;?>"></div>
						<div id="grafica_consumo_cpu" class="cpu_<?php echo $i;?>"></div>
					</div>
					<?php endfor;?>
				</div>
				<script>
				jQuery(window).load(function () {
					graph();
					setInterval(function(){
						graph();
					}, 60000);
					function graph(){
						$.get("test/graphs", function(data) {
							var cpuRamComplete = data.split(",");
							for (var i = 0; i < 20; i++) {
								var cpuRam = cpuRamComplete[i].split("-");
								$(".cpu_" + i).css("line-height", (cpuRam[0]*2) + "px");
								$(".cpu_" + i).css("height", (cpuRam[0]*2) + "px");
								
								$(".ram_" + i).css("height", (cpuRam[1]*2) + "px");
								$(".ram_" + i).css("line-height", (cpuRam[1]*2) + "px");
								
								$(".cpu_" + i).text(cpuRam[0]);
								$(".ram_" + i).text(cpuRam[1]);
							}
						});
					}
					
				});
				</script>
				<br><h3>Consumo servidor (14 horas con 36 minutos).</h3>
				<div id="grafica_trasera">
					<?php for ($i = 0; $i < 876; $i++):?>
					<div id="grafica_consumo_h">
						<div id="grafica_consumo_ram_h" class="ram_h_<?php echo $i;?>"></div>
						<div id="grafica_consumo_cpu_h" class="cpu_h_<?php echo $i;?>"></div>
					</div>
					<?php endfor;?>
				</div>
				<script>
				jQuery(window).load(function () {
					graph();
					setInterval(function(){
						graph();
					}, 60000);
					function graph(){
						$.get("test/graphs", function(data) {
							var cpuRamComplete = data.split(",");
							for (var i = 0; i < 876; i++) {
								var cpuRam = cpuRamComplete[i].split("-");
								$(".cpu_h_" + i).css("height", (cpuRam[0]*2) + "px");
								$(".ram_h_" + i).css("height", (cpuRam[1]*2) + "px");
							}
						});
					}
					
				});
				</script>
				<br><hr><br>
				<h3>Enviar mail a...</h3>
				<br>
				<form class="form" method="post">
					<input name="Send_mail" id="Send_mail" class="creacion_box" placeholder="Email" size="34" autocomplete="off" type="text">
					<textarea name="Send_text" id="send_textarea"></textarea>
					<div id="br"><br></div>
					<button id="Send" name="Send" class="creacion_boton" type="submit">enviar</button>
					<button id="SendATodos" name="SendATodos" class="creacion_boton" type="submit">enviar a todos los usuarios</button>
				</form>
				<!-- EJEMPLOS -->
				<h3>Ejemplos mails</h3>
				<h4>No email, no nick</h4>
				<hr>
				<?php echo htmlspecialchars("Gracias por la donación,<br/> 
							pero no hemos recibido ningún correo electrónico de contacto ni tampoco ningún nick de minecraft asociado.
							Ponte en contacto con nosotros con el correo <b>donaciones@bewom.es</b> para solucionar este problema!")?>
				<hr>
				<h4>Nueva donación</h4>
				<?php echo htmlspecialchars("
						Gracias por la donación <b>%nombreDeUsuario%</b>, <br>
						Ya puedes entrar al servidor en fase <b>BETA</b>.<br><br>
						En el servidor tendrás que seguir unos pasos para poderte registrar en la web, pero no te preocupes son muy sencillos.<br><br>
						
						Recuerda descargarte el instalador de bewom para poder entrar al servidor, si tuvieses problemas con él, ponte en contacto con nosotros.<br><br>
						Tranquilo, tu vip solo se gastará los dias que el servidor este funcionando perfectamente, el resto de dias que tu no puedas jugar correctamente,
						no serán descontados... :)<br><br>
						Nos vemos dentro de muy poco en el servidor... <3
						")?>
				<hr/>
				<h4>Apertura BETA</h4>
				<?php echo htmlspecialchars("
						Hola,<br>
						el gran momento ha llegado...<br><br>
						
						<b>BEWOM</b> abre sus puertas en fase <b>BETA</b>!!<br>
						Desde la administración, esperamos que te encante este lavado de cara que hemos sufrido por muchas consecuencias externas a nosotros. Sabemos que os encanta pixelmon y minecraft y unidos son magia. Por ello, nos centraremos en exclusiva a llevaros al máximo con esta experiencia. <br>
						Durante esta <b>BETA</b> habrá errores a montones, así que hemos abierto un apartado en el foro para que podáis reportarlos y ayudarnos a repararlos lo antes posible, tambien nos podréis dar sugerencias para mejorar esa experiencia de jugador.<br><br>
						Recordad que esto es una <b>BETA</b> e implica algunos sacrificios. El servidor no estará 24 horas abierto para vosotros, para intentar arreglar esos molestos errores y poder preparar la maquina para que todo salga perfecto. A cambio, nosotros, no os descontaremos ningun día de <b>VIP</b> hasta que el servidor no este operativo para todos los jugadores. <br><b>NO</b>, no perderéis ningún pokemon, inventario, enderchest, cofre... cuando se abra al público, así que aprovechad esta ventaja.<br>
						Esperamos que durante esta <b>BETA</b> os comportéis y entendáis que los administradores podemos estar ocupados arreglando errores, ya que son nuestra preferencia en este momento, en resumen, podemos llegar a ignorar un poco lo que hagáis o nos digáis.<br><br>
						En serio, deseamos de todo corazón que disfrutéis de esta nueva experiencia y que os encante.<br><br>
						Y por último, el servidor estará disponbile a partir del 25 de Agosto de 2015 a las 18:00 (6:00pm) [hora de España peninsular] de forma indefinida, aunque no estará disponible mas tarde de las 2 de la mañana (y así será el horario hasta que os mandemos otro email).<br><br>
						PD: Lamentamos que los que tengáis hotmail u otros, no podáis disfrutar de los correos tan bonitos que hemos diseñado, intentaremos arreglarlo cuanto antes!
						");?>
						
				<hr/><br /><hr/>
				<h4>Torneo Nuevo</h4>
				<?php echo htmlspecialchars("<center><div style='background-color: rgb(249, 131, 152);' id='full_title_torneo'><div id='titulo_torneo'>Bewom World Tournament VII</div><div id='diaHora_torneo'>(06/12/15 - 19:00)</div></div></center><div id='interior_torneo'>		<b>¿Donde y cuando se realizará el torneo </b>
							Se realizará en el coliseo, que encontraras a la izquierda si haces <b>/spawn</b>, en la puerta de piedra. A las 19:00 (hora peninsular española) de este Domingo.<br />
							<b>Normas para participar.</b>
							- Cada entrenador tendrá que llevar un máximo de 6 pokemons lvl50 (puedes llevar menos pokemons pero todos al nivel 50, no hay escepciones).
							- Si os inscribis en el torneo, tendreis que participar o os restaremos un punto. Si tenéis puntos negativos, no podreis participar en una semana (tendréis que asistir igualmente para que se descuenten).
							- No esta permitido el uso de pociones.
							- Si algun movimiento esta 'bug', se prohibira usar y la persona que este luchando, podra reportarlo para que la persona quede descalificada.
							- Una vez aparezca tu nombre en el chat para que empiece tu combate, no se puede salir de alli­. En caso de caida del servidor, los administradores esperaremos un maximo de 3 minutos.
							- Los 3 premios se repartiran al final, si el usuario no esta, no se le dara el premio.
							- Si alguien se queda AFK o tarda mucho en un combate, podra ser descalificado.
							- El incumplimiento de cualquiera de estas normas significara la descalificacion inmediata del jugador.
							
							<b>Premios</b>
							- El ganador, recibira un pokemon shiny a eleccion y con naturaleza a eleccion (legendarios no), 100K woms y 3 puntos en la clasificacion.
							- El segundo, recibira un pokemon a eleccion y con naturaleza a eleccion (legendarios no), 50K woms y 2 puntos en la clasificacion.
							- El tercero, recibira una MT o MO a eleccion, 25K woms y 1 punto en la clasificacion.
							
							- Los usuarios que no se presenten y se hayan inscrito recibiran -1 punto.
							- Los usuarios que tengan puntos negativos y se presenten, recuperaran 1 punto.
							
							<b>Para inscribirte, haz click en el boton de abajo, una vez inscrito no podras desinscribirte, piensatelo bien!</b><br /></div><center><form method='post' id='submit_torneo_form'><button name='torneo' id='Submit_torneo' type='submit'>Inscribirme</button></form></center>");?>
			</center>
		</div>
	</div>
</div>

</body>
<?php endif;?>
<?php endif;?>
<?php include 'include/general/footer.php';?>