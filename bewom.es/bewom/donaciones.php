<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

if(!isValidSession()):
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:

if(isset($_POST["submit"])){
	$key0 = $_POST["key0"];
	$key1 = $_POST["key1"];
	$key2 = $_POST["key2"];
	$key3 = $_POST["key3"];
		
	if(strlen($key0) == 4 && strlen($key1) == 4 && strlen($key2) == 4 && strlen($key3) == 4){
		sendPaysafecard(getCurrentUser()->name, $key0."-".$key1."-".$key2."-".$key3);
	}
	
}

$paypal = $_POST["paypal"];

if(!empty($paypal)){
	sendPaypal(getCurrentUser()->name);
}

?>
<style>
.keys {
    background-color: #FFF;
    border: 1px solid #BABABA;
    box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.25) inset;
    box-sizing: border-box;
    text-align: center;
    padding: 2px;
    color: #606060;
    font-size: 16px;
    width: 70px;
}

.boton{
	display: table-cell;
	background-color: #008ac9;
	color: #FFF;
	font-weight: bold;
	border: 0px solid;
	border-bottom: 2px solid #004a6d;
	font-size: 16px;
	height: 25px;
}
.boton:active{
	border-top: 2px solid #004a6d;
	border-bottom: 0px solid #004a6d;
}
</style>
<body>

<div id="barebone">
	<div id="page" style="background: rgb(223, 223, 223) url('../assets/vip.png') repeat scroll 0% 0%; border-color: #00AAAA;">
	
		<h2>Donaciones</h2>
		<hr class="vipBa">
		<br>
		
		<!-- VENTAJAS -->
		
		<h3>Ventajas de ser usuario <b>VIP</b></h3>
		<hr>
		
		<br>- Satisfacción personal de saber que el servidor seguirá adelante.
		<br>- Reconocimiento en la web y en el servidor mediante el color de nick <i>DARK_AQUA</i>.
		<br>- Poder ir al centro pokemon mas cercano con un comando.
		<br>- Poder teletransportarte a quien quieras.
		<br>- Poder asignar una zona y volver a ella cuando quieras.
		<br>- Abrir el enderchest cuando quieras.
		<br>- Añadir amigos para que puedan entrar a tu casa libremente.
		<br>- Curar a tus pokemons cuando lo necesites con un comando.
		<br>- Comando exclusivos. <a href="/comandos" style="font-weight: bold;">Más info</a>.
		<br>- Tener mas de una casa.
		<br>- Tener mas de una zona.
		<br>- Poder teletransportarte a tus amigos sin necesidad de pedir una solicitud.
		
		<br>
		<br>
		<!-- FIN VENTAJAS -->
		
		<h3>Donación por <b>PAYPAL</b></h3>
		<hr><br>
		<b>Primero:</b>
		<br>- Introduce un mínimo de <a class="admin"><b><i>3€</i></b></a> en el <b>importe del donativo</b>. 
		<br>- Aunque sea superior a <a class="admin"><b><i>3€</i></b></a>, solo lo contaremos una vez y por lo tanto, serán 30 dias.
		<br>- Inicia sesión en <b>paypal</b> o introduce los datos de tu <b>tarjeta</b>.
		<br><br><b>Segundo:</b>
		<br>- Pulsa en <b>'Añadir instrucciones especiales para el vendedor'</b> y escribe tu nombre de usuario de minecraft y tu correo electrónico de contacto</b>.
		<br>- Confirma tus datos personales <b>que jamás compartas con nadie, ni con nosotros</b>.
		<br>- Pulsa <b>donar ahora</b>.
		<br>- Las donaciones que se devuelvan, se auto considerarán <b>baneos permanentes del servidor</b>. Si no quieres donar, no dones.
		<br><br><b>Tercero:</b>
		<br>- Verificaremos la donación manualmente, ten paciencia y tranquilo, el tiempo del vip no empezará a descontar hasta que no se active!
		<br /><br />
		<form target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="height: 0px;margin: 0px;padding: 0px;">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="WXA5WG3F6WRRN">
			<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
			<button id="spp1"></button>
		</form>
		<form method="post" style="height: 0px;margin: 0px;padding: 0px;">
			<input name="paypal" style="height: 0px; width: 0px; padding: 0px; margin: 0px;" value="paypal"></input>
			<button id="spp2"></button>
		</form>
		<button id="submitPaypal" class="boton" name="submit" type="submit">Donar por paypal</button>
		
		<script>
		jQuery(document).ready(function(){
		    jQuery('#submitPaypal').on('click', function(){
		    	jQuery('#spp2').simulateClick('click');
				jQuery('#spp1').simulateClick('click');
		    });
		});

		jQuery.fn.simulateClick = function() {
		    return this.each(function() {
		        if('createEvent' in document) {
		            var doc = this.ownerDocument,
		                evt = doc.createEvent('MouseEvents');
		            evt.initMouseEvent('click', true, true, doc.defaultView, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
		            this.dispatchEvent(evt);
		        } else {
		            this.click(); // IE
		        }
		    });
		}
		</script>
		
		<br />
		<br />
		<h3>Donación por <b>PAYSAFECARD</b></h3>
		<hr><br>
		<b>Primero:</b>
		<br>- Compra una tarjeta <b>valida</b> de <a class="admin"><b><i>10€</i></b></a> o mas de paysafecard.
		<br>- Aunque sea superior a <a class="admin"><b><i>10€</i></b></a>, solo lo contaremos una vez y por lo tanto, serán 100 dias igualmente.
		<br><br><b>Segundo:</b>
		<br>- Introduce tu código de paysafecard abajo.
		<br>- Recuerda que comprobaremos el valor del código paysafecard, así que <b>no nos envies uno falso o usado</b>. 
		<br> (En caso de enviar un código falso o sin ningún valor, podrás ser sancionado del servidor)
		<br><br><b>Tercero:</b>
		<br>- Verificaremos el código manualmente, ten paciencia y tranquilo, el tiempo del vip no empezará a descontar hasta que no se active!
		<br><br>
		<div>
			<form method="post">
				<?php for ($i = 0; $i < 4; $i++):?>
				<input name="key<?php echo $i;?>" class="keys" maxlength="4"></input>
				<?php endfor;?>
				<br>
				<br>
				<button class="boton" name="submit" type="submit">Donar código paysafecard</button>
			</form>
		</div>
		<?php //include 'include/donaciones/donaciones.php';?>
		
	</div>
</div>

</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>