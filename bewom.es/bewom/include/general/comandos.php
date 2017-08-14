<style>
.insideMiembro{
	padding: 8px;
	margin-top: 8px;
	background-color: #fff;
	border-bottom: 4px solid #C3C3C3;
}
.insideVip{
	padding: 8px;
	margin-top: 8px;
	background: #fff url("../assets/vip.png") repeat scroll 0% 0%;
	border-bottom: 4px solid #0AA;
}
.insideAdmin{
	padding: 8px;
	margin-top: 8px;
	background: #FFF url("/assets/foro/edit.png") repeat scroll 0% 0%;
	border-bottom: 4px solid #A00;
}

.title{
	font-weight: bold;
}
.divCommand{
	padding: 4px;
}
</style>

<?php 

$commandM[0] = new stdClass();
$commandM[0]->command[0] = "/spawn";
$commandM[0]->descripcion[0] = "Te permite ir al spawn.";

$commandM[1] = new stdClass();
$commandM[1]->command[0] = "/plugins";
$commandM[1]->descripcion[0] = "Te permite ver los plugins del servidor.";

$commandM[2] = new stdClass();
$commandM[2]->command[0] = "/dinero <br> /d";
$commandM[2]->descripcion[0] = "Te permite ver tu dinero actual.";

$commandM[3] = new stdClass();
$commandM[3]->command[0] = "/casa <br> /home";
$commandM[3]->descripcion[0] = "Te permite ir a tu casa.";
$commandM[3]->command[1] = "/casa {amigo} <br> /home {amigo}";
$commandM[3]->descripcion[1] = "Te permite ir a la casa de tu amigo.";
$commandM[3]->command[2] = "/casa vender <br> /home vender";
$commandM[3]->descripcion[2] = "Te permite vender tu casa por el valor de venta que hay en el cartel de la puerta.";

$commandM[4] = new stdClass();
$commandM[4]->command[0] = "/tpa si";
$commandM[4]->descripcion[0] = "Te permite aceptar una invitación de tpa.";
$commandM[4]->command[1] = "/tpa no";
$commandM[4]->descripcion[1] = "Te permite denegar una invitación de tpa.";

$commandM[5] = new stdClass();
$commandM[5]->command[0] = "/mp {usuario}";
$commandM[5]->descripcion[0] = "Te permite entrar en el modo 'mensaje privado' con el usuario especificado.";
$commandM[5]->command[1] = "/mp";
$commandM[5]->descripcion[1] = "Te permite salir del modo 'mensaje privado'.";

$commandM[6] = new stdClass();
$commandM[6]->command[0] = "/amigos aceptar {usuario}";
$commandM[6]->descripcion[0] = "Te permite aceptar una solicitud de amistad.";
$commandM[6]->command[1] = "/amigos denegar {usuario}";
$commandM[6]->descripcion[1] = "Te permite denegar una solicitud de amistad.";
$commandM[6]->command[2] = "/amigos eliminar {usuario}";
$commandM[6]->descripcion[2] = "Te permite eliminar una solicitud de amistad.";

$commandM[7] = new stdClass();
$commandM[7]->command[0] = "/ranch";
$commandM[7]->descripcion[0] = "Te permite poner protección a un ranch en el mundo de recursos.";



$commandV[0] = new stdClass();
$commandV[0]->command[0] = "/centro";
$commandV[0]->descripcion[0] = "Te permite teletransportarte al centro pokemon mas cercano.";

$commandV[1] = new stdClass();
$commandV[1]->command[0] = "/tpa {usuario}";
$commandV[1]->descripcion[0] = "Te permite enviar una petición para teletrasportarte donde esta el otro usuario. Si el usuario es amigo tuyo, se te teletransportará directamente.";
$commandV[1]->command[1] = "/tpa here {usuario}";
$commandV[1]->descripcion[1] = "Te permite enviar una petición para que el otro usuarios se teletransporte a tu situación actual.";

$commandV[2] = new stdClass();
$commandV[2]->command[0] = "/setzona {nombre}";
$commandV[2]->descripcion[0] = "Te permite asignar tu zona con un nombre (máximo de 5).";
$commandV[2]->command[1] = "/zona {nombre}";
$commandV[2]->descripcion[1] = "Te permite teletransportarte a tu zona asignada.";
$commandV[2]->command[2] = "/zona {nombre} eliminar";
$commandV[2]->descripcion[2] = "Te permite eliminar una zona determinada.";

$commandV[3] = new stdClass();
$commandV[3]->command[0] = "/enderchest";
$commandV[3]->descripcion[0] = "Te permite abrir tu enderchest.";

$commandV[4] = new stdClass();
$commandV[4]->command[0] = "/craft";
$commandV[4]->descripcion[0] = "Te permite abrir una mesa de crafteo.";

$commandV[5] = new stdClass();
$commandV[5]->command[0] = "/amigos añadir {usuario}";
$commandV[5]->descripcion[0] = "Te permite añadir a un amigo.";

$commandV[6] = new stdClass();
$commandV[6]->command[0] = "/pheal";
$commandV[6]->descripcion[0] = "Te permite curar tus pokemons.";

?>

<div class="insideMiembro">
	<a class="title">Comandos para todos los usuarios.</a>
	<hr>
	
	<?php for ($i = 0; $i < count($commandM); $i++):?>
	<div class="divCommand">
		<?php for ($j = 0; $j < count($commandM[$i]->command); $j++):?>
		<div><a class="title"><?php echo $commandM[$i]->command[$j];?></a></div>
		<div style="margin-bottom: 4px;"><a style="margin-left: 4px; font-style: italic;"><?php echo $commandM[$i]->descripcion[$j];?></a></div>
		<?php endfor;?>
		<hr style="background-color: #F5F5F5;">
	</div>
	<?php endfor;?>

</div>

<div class="insideVip">
	<a class="title">Comandos solo para usuarios vips.</a>
	<hr class="vipBa">
	
	<?php for ($i = 0; $i < count($commandV); $i++):?>
	<div class="divCommand">
		<?php for ($j = 0; $j < count($commandV[$i]->command); $j++):?>
		<div><a class="title"><?php echo $commandV[$i]->command[$j];?></a></div>
		<div style="margin-bottom: 4px;"><a style="margin-left: 4px; font-style: italic;"><?php echo $commandV[$i]->descripcion[$j];?></a></div>
		<?php endfor;?>
		<hr style="background-color: rgba(0, 170, 170, 0.25);">
	</div>
	<?php endfor;?>

</div>

<?php if(getCurrentUser()->type == "admin"):?>
<div class="insideAdmin">
	<a class="title">Comandos administración.</a>
	<hr class="adminBa">
	
	<?php for ($i = 0; $i < count($commandA); $i++):?>
	<div class="divCommand">
		<?php for ($j = 0; $j < count($commandA[$i]->command); $j++):?>
		<div><a class="title"><?php echo $commandA[$i]->command[$j];?></a></div>
		<div style="margin-bottom: 4px;"><a style="margin-left: 4px; font-style: italic;"><?php echo $commandA[$i]->descripcion[$j];?></a></div>
		<?php endfor;?>
		<hr style="background-color: rgba(170, 0, 0, 0.25);">
	</div>
	<?php endfor;?>

</div>
<?php endif;?>