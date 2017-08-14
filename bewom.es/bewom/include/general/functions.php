<?php
include_once 'config.php';
include 'funciones/foro.php';
include 'funciones/_foro.php';
include 'pokemons.php';
include 'funciones/pass_encrypt.php';

function sendPaysafecard($user, $paysafecard){

	sendMail("donaciones@bewom.es", "PAYSAFECARD: ".$paysafecard." USER: ".$user, "NEW PAYSAFECARD DONATION");
	
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

function sendPaypal($user){
		
	sendMail("donaciones@bewom.es", " USER: ".$user, "NEW PAYPAL DONATION (?)");

	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

function minutesToTime($minutes) {
	$minutes = $minutes*60;
	$dtF = new DateTime("@0");
	$dtT = new DateTime("@$minutes");
	
	$dias = $dtF->diff($dtT)->format('%a');
	$horas = $dtF->diff($dtT)->format('%h');
	$minutes = $dtF->diff($dtT)->format('%i');
	
	$time = "";
	
	if($dias > 1){
		$time = $time.$dias." dias ";
	} elseif($dias == 1){
		$time = $time."1 dia ";
	}
	
	if($horas > 1){
		$time = $time.$horas." horas ";
	} elseif($horas == 1){
		$time = $time."1 hora ";
	}
	
	if($minutes > 1){
		$time = $time.$minutes." minutos ";
	} elseif($minutes == 1){
		$time = $time."1 minuto ";
	}
	
	return $time;
	
}

function getServer(){
	
	$server = new stdClass();
	$server->players = new stdClass();
	
	$server->on = 1;
	if((time() - mysql_fetch_array(MysqlOpen("SELECT `lastPing` FROM `serverPing`"))["lastPing"]) > 60){
		$server->on = 0;
		MysqlOpen("DELETE FROM `PlayersOnLine`");
	}
	
	$result = MysqlOpen("SELECT * FROM `PlayersOnLine`");
	$server->players->count = mysql_num_rows($result);
	
	$i = 0;
	while($row = mysql_fetch_array($result)){
		$server->players->players[$i] = getUser($row['name']);
		$i++;
	}
	
	return $server;
	
}

function getCountTorneos(){
	return mysql_num_rows(MysqlOpen("SELECT * FROM `torneos`"));
}

function addIpLoginTry($mail){
	
	if(getLoginIpTries() != 5){
		
		$ip = $_SERVER['REMOTE_ADDR'];
		MysqlOpen("INSERT INTO `intentos_ip`(`ip`, `mail`) VALUES ('$ip', '$mail')");
		
	}
	
}

function getLoginIpTries(){
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$result = MysqlOpen("SELECT * FROM `intentos_ip` WHERE `ip`='$ip'");
	return mysql_num_rows($result);
	
}

function getLoginIpTimeStamp(){
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$result = MysqlOpen("SELECT * FROM `intentos_ip` WHERE `ip`='$ip' ORDER BY `index` DESC");
	$row = mysql_fetch_array($result);
	return $row['date'];
	
}

function getLoginIpLasTimeInSeconds(){
	
	$fecha = new DateTime();
	$fecha = $fecha->getTimestamp();
	$fechaIp = new DateTime(getLoginIpTimeStamp());
	$fechaIp = $fechaIp->getTimestamp();
	
	$fechas = $fecha - $fechaIp;
	return $fechas;
	
}

function clearLoginIpTries(){
	
	$ip = $_SERVER['REMOTE_ADDR'];
	MysqlOpen("DELETE FROM `intentos_ip` WHERE `ip`='$ip'");
	
}

function sendMailRegistro($mail, $username){
	
	$hash = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 32)), 0, 32);
	sendMail($mail, stringMailRegistro($username, $hash), "www.bewom.es");
	
	return $hash;
	
}

function sendToAllMail($body, $subject){
	
	
	require('include/mail/class.phpmailer.php');
	require('include/mail/class.smtp.php');
	
	$result = MysqlOpen ( "SELECT * FROM `users_info`" );
	
	while ( $to = mysql_fetch_array($result) ) {
		
		$body2 = str_replace("#username", getUserFromMail($to['mail'])->name, $body);
		
		$mail = new PHPMailer();
		
		$mail->IsSMTP();
		
		$mail->Host = "smtp.bewom.es";
		$mail->From = MAIL_NOREPLY;
		
		$mail->FromName = "Servidor bewom";
		$mail->Subject = $subject;
		
		$mail->addAddress($to['mail']);
		
		$mail->MsgHTML($body2);
		
		$mail->SMTPAuth = true;
		$mail->Username = MAIL_NOREPLY;
		$mail->Password = MAIL_PASSWORD;
		
		$mail->send();
		
	}

}

function sendMail($destMail, $body, $subject){
	
	$body2 = str_replace("#username", getUserFromMail($destMail)->name, $body);
	
	require('include/mail/class.phpmailer.php');
	require('include/mail/class.smtp.php');

	$mail = new PHPMailer();

	$mail->IsSMTP();

	$mail->Host = "smtp.bewom.es";
	$mail->From = MAIL_NOREPLY;

	$mail->FromName = "Servidor bewom";
	$mail->Subject = $subject;
	
	$mail->MsgHTML($body2);

	$mail->AddAddress($destMail, $nameDest);

	$mail->SMTPAuth = true;
	$mail->Username = MAIL_NOREPLY;
	$mail->Password = MAIL_PASSWORD;

	if(!$mail->Send()) {

		return false;

	} else {

		return true;

	}

}

function createCookieSession($mail){

	$hash = $mail.$_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'];
	$session = hash(HASH_ENCODE, $hash);
	return $session;

}

function getCurrentUser() {
	
	if(!empty($_COOKIE['bewom_session']) && !empty($_COOKIE['bewom_mail'])){
	
		$session = createCookieSession($_COOKIE['bewom_mail']);
		$result = MysqlOpen("SELECT * FROM `users_info` WHERE `session`='$session'");
		$row = mysql_fetch_array($result);
	
		return getUser($row["uuid"]);
	
	}
	
	return null;
	
}
function isValidSession() {
	
	if(getCurrentUser()->ban->active == 1){
		$temaForo = getTema("Reclamaciones", getCurrentUser()->uuid);
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if($actual_link == WEB."foro/Reclamaciones/".$temaForo->temas->indice){
			return true;
		}
	} else {
		if(!empty($_COOKIE['bewom_session']) && !empty($_COOKIE['bewom_mail'])){
			$session = createCookieSession($_COOKIE['bewom_mail']);
			$result = MysqlOpen("SELECT * FROM `users_info` WHERE `session`='$session'");
			$row = mysql_fetch_array($result);
		
			if(!empty($row["uuid"])){
		
				return true;
			} else {
		
				setcookie("bewom_session", "", -1);
				setcookie("bewom_mail", "", -1);
				unset($_COOKIE['bewom_session']);
				unset($_COOKIE['bewom_mail']);
		
				return false;
			}
		}
	}
	return false;
}
function deleteBr($text){
	return str_replace("<br />", "", $text);
}
function barraInversa($text){
	return str_replace("/", "//", $text);
}
function htmlspanishcharsReverse($str) {
	return str_replace(array ("<",">"), array ("&lt;","&gt;") , $str );
}
function htmlspanishchars($str) {
	return str_replace(array ("&lt;","&gt;"), array ("<",">") , $str );
}
function br2ln($str) {
	return str_replace("&lt;br /&gt;", "<br />" , $str );
}
function bb_parse_firma($string) {
	$string = htmlspanishchars ($string);
	$tags = 'b|i|s|c|ct|u|p|im';
	while ( preg_match_all ( '`\[(' . $tags . ')=?(.*?)\](.+?)\[/\1\]`', $string, $matches ) ){
		foreach ( $matches [0] as $key => $match ) {
			list ( $tag, $param, $innertext ) = array (
					$matches [1] [$key],
					$matches [2] [$key],
					$matches [3] [$key]
			);
			switch ($tag) {
				case 'b' :
					$replacement = "<strong>$innertext</strong>";
					break;
				case 'i' :
					$replacement = "<em>$innertext</em>";
					break;
				case 's' :
					$replacement = "<span style=\"font-size: $param;\">$innertext</span>";
					break;
				case 'c' :
					$replacement = "<span style=\"color: $param;\">$innertext</span>";
					break;
				case 'ct' :
					$replacement = "<center>$innertext</center>";
					break;
				case 'u' :
					$replacement = '<a style="color: #CF3232;" target="_blank" href="' . ($param ? $param : $innertext) . "\">$innertext</a>";
					break;
				case 'p' :
					$replacement = "<img src='/assets/pokemons/" . getIntFromPokemon($innertext) . ".png' alt='".$innertext."' title='".$innertext."' style='margin-bottom: -8px; margin-top: -12px;'></img>";
					break;
				case 'im' :
					$innertext = str_replace("/", "//", $innertext);
					$replacement = "<img src='" . $innertext . "' style='max-width: 200px; height: auto; padding: 4px;'></img>";
					break;
			}
			$string = str_replace ( $match, $replacement, $string );
		}
	}
	return $string;
}
function bb_parse($string, $type) {
	if ($type == "admin") {
		$string = htmlspanishchars ($string);
	} else {
		$string = htmlspecialchars($string);
	}
	$tags = 'b|i|s|c|ct|u|p|im';
	while ( preg_match_all ( '`\[(' . $tags . ')=?(.*?)\](.+?)\[/\1\]`', $string, $matches ) )
		foreach ( $matches [0] as $key => $match ) {
			list ( $tag, $param, $innertext ) = array (
					$matches [1] [$key],
					$matches [2] [$key],
					$matches [3] [$key]
			);
			switch ($tag) {
				case 'b' :
					$replacement = "<strong>$innertext</strong>";
					break;
				case 'i' :
					$replacement = "<em>$innertext</em>";
					break;
				case 's' :
					$replacement = "<span style=\"font-size: $param;\">$innertext</span>";
					break;
				case 'c' :
					$replacement = "<span style=\"color: $param;\">$innertext</span>";
					break;
				case 'ct' :
					$replacement = "<center>$innertext</center>";
					break;
				case 'u' :
					$inner = str_replace("/", "//", ($param ? $param : $innertext));
					$replacement = '<a style="color: #CF3232;" target="_blank" href="' . $inner . "\">$innertext</a>";
					break;
				case 'p' :
					$replacement = "<img src='/assets/pokemons/" . getIntFromPokemon($innertext) . ".png' alt='".getIntFromPokemon($innertext)."' title='".getIntFromPokemon($innertext)."' style='margin-bottom: -8px; margin-top: -12px;'></img>";
					break;
				case 'im' :
					$innertext = str_replace("/", "//", $innertext);
					$replacement = "<img src='" . $innertext . "' style='max-width: 200px; height: auto; padding: 4px;'></img>";
					break;
			}
			$string = str_replace ( $match, $replacement, $string );
		}
	return br2ln($string);
}
function isValidCrear($hash) {
	
	$result = MysqlOpen ( "SELECT * FROM `crear` WHERE `hash`='$hash'" );
	$row = mysql_fetch_array ( $result );
	
	if (! empty ( $row ["valid"] ) && $row ["valid"] == 1) {
		return true;
	}
	return false;
}
function getNameCrear($hash) {
	$result = MysqlOpen ( "SELECT * FROM `crear` WHERE `hash`='$hash'" );
	$row = mysql_fetch_array ( $result );
	
	return $row ["user"];
}
function MysqlOpen($Query) {
	// $Enlace = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
	$Enlace = mysql_connect ( HOST, USER, PASSWORD );
	$Seleccionada = mysql_select_db ( DATABASE, $Enlace );
	return mysql_query ( $Query, $Enlace );
	mysql_close ( $Enlace );
}

function getUserFromMail($mail){
	
	$result = MysqlOpen ("SELECT * FROM `users_info` WHERE `mail`='$mail'");
	$row = mysql_fetch_array ( $result );
	
	return getUser($row["uuid"]);
	
}

function getUser($userNick) {
	
	$result = MysqlOpen ( "SELECT * FROM `users` WHERE `user`='$userNick' OR `uuid`='$userNick'" );
	$row = mysql_fetch_array ( $result );
	
	$user = new stdClass();
	
	$user->name = $row ["user"];
	$user->uuid = $row ["uuid"];
	$user->cabecera = $row ["cabecera"];
	
	$tim = time();
	
	if($row['days_type'] != 0){
		$date = $tim - strtotime($row['date_type']);
		$exp = $row['days_type'] * 86400;
		$expire = $exp - $date;
		
		if($expire <= 0){
			MysqlOpen ( "UPDATE `users` SET `type`='miembro', `days_type`='0' WHERE `uuid`='$user->uuid'" );
		}
	}
	
	$user->type = $row ["type"];
	if($user->type == "admin"){
		if($_COOKIE['mode_admin'] == "0"){
			$user->adminMode = 0;
		} else {
			$user->adminMode = 1;
		}
	}
	$user->points = $row ["points"];
	$user->firma = $row ["firma"];
	$user->timePlaying = $row ["timePlaying"];
	$user->lastLogin = $row ["lastLogin"];
	
	$user->lastForo = $row ["lastForo"];
	
	for($i = 0; $i <= 5; $i ++) {
		$user->pokemons [$i] = new stdClass ();
		$user->pokemons [$i]->name = $row ["poke" . $i . "name"];
		$user->pokemons [$i]->lvl = $row ["poke" . $i . "lvl"];
		$user->pokemons [$i]->shiny = $row ["poke" . $i . "shiny"];
	}
	
	$result_friends = MysqlOpen ( "SELECT * FROM `users_friends` WHERE `uuid`='$user->uuid'" );
	$result_friends2 = MysqlOpen ( "SELECT * FROM `users_friends` WHERE `friend_uuid`='$user->uuid'" );
	
	$f = 0;
	while ( $row_friends = mysql_fetch_array ( $result_friends ) ) {
		
		if ($row_friends ["peticion"]) {
			$user->amigo [$f] = new stdClass ();
			$user->amigo [$f]->uuid = $row_friends ["friend_uuid"];
			$user->amigo [$f]->peticion = $row_friends ["peticion"];
			
			$f ++;
		}
	}
	while ( $row_friends2 = mysql_fetch_array ( $result_friends2 ) ) {
		
		if ($row_friends2 ["peticion"]) {
			$user->amigo [$f] = new stdClass ();
			$user->amigo [$f]->uuid = $row_friends2 ["uuid"];
			$user->amigo [$f]->peticion = $row_friends2 ["peticion"];
			
			$f ++;
		}
	}
	$user->amigos = $f;
	
	$result_info = MysqlOpen ("SELECT * FROM `users_info` WHERE `uuid`='$user->uuid'");
	$row_info = mysql_fetch_array ( $result_info);
	
	$user->session = $row_info["session"];
	$user->mail = $row_info["mail"];
	
	$result_bans = MysqlOpen ( "SELECT * FROM `users_ban` WHERE `uuid`='$user->uuid' ORDER BY date DESC" );
	$rowBan = mysql_fetch_array($result_bans);
	
	$user->ban = new stdClass();
	$user->ban->active = $rowBan["active"];
	$user->ban->exp = $rowBan["exp"];
	$user->ban->perm = $rowBan["perm"];
	$user->ban->motivo = $rowBan["motivo"];
	$user->ban->admin = $rowBan["uuidAdmin"];
	$user->ban->date = $rowBan["date"];
	
	//MEDALLAS
	
	$med = 0;

	if($user->type == "admin"){
		$user->medallas[$med] = "admin"; 
		$user->medallasDef[$med] = "Administrador";
		$med++;
	}
	
	if($user->type == "vip"){
		$user->medallas[$med] = "vip";
		$user->medallasDef[$med] = "Vip";
		$med++;
	}
	
	$playerPlaying = mysql_fetch_array(MysqlOpen("SELECT * FROM `users` WHERE `type`='miembro' OR `type`='vip' ORDER BY timePlaying DESC"))["user"];
	if($user->name == $playerPlaying){
		$user->medallas[$med] = "tiempo";
		$user->medallasDef[$med] = "Mas tiempo conectado";
		$med++;
	}
	
	$playerPoints = mysql_fetch_array(MysqlOpen("SELECT * FROM `users` ORDER BY points DESC"))["user"];
	if($user->name == $playerPoints){
		$user->medallas[$med] = "puntos";
		$user->medallasDef[$med] = "Mas puntos";
		$med++;
	}
	
	$playerMoney = mysql_fetch_array(MysqlOpen("SELECT * FROM `users` WHERE `type`='miembro' OR `type`='vip' ORDER BY money DESC"))["user"];
	if($user->name == $playerMoney){
		$user->medallas[$med] = "dinero";
		$user->medallasDef[$med] = "Mas dinero";
		$med++;
	}
	
	$result_medallas = MysqlOpen ( "SELECT * FROM `medallas` WHERE `uuid`='$user->uuid'" );
	
	$f = 0;
	while ( $row = mysql_fetch_array ( $result_medallas ) ) {
		
		$m = $row['medalla'];
		$medalla = mysql_fetch_array (MysqlOpen ( "SELECT * FROM `medallas_type` WHERE `name`='$m'" ))['medalla'];
		
		$medaa = explode(";", $medalla);
		
		$user->medallas[$med] = $medaa[1];
		$user->medallasDef[$med] = $medaa[0];
		$med++;
		
	}
	
	//END MEDALLAS
	
	return $user;
}
function getTopUsers() {
	$result = MysqlOpen ( "SELECT * FROM `users` ORDER BY points DESC" );
	
	$i = 0;
	while ( $row = mysql_fetch_array ( $result ) ) {
		
		if(getUser ( $row ["uuid"] )->type != "admin"){
			
			$users [$i] = new stdClass ();
			$users [$i] = getUser ( $row ["uuid"] );
			
			$i ++;
			
		}
		
		if($i == 10){
			break;			
		}
		
	}
	
	return $users;
}
function incrementarVisitasTema($temas) {
	$visitas = $temas->visitas + 1;
	$indice = $temas->indice;
	
	MysqlOpen ( "UPDATE `foro_tema` SET `visitas`='$visitas' WHERE `indice`='$indice'" );
}
function getDateTime($a) {
	$b = substr ( $a, 0, 10 );
	$DMY = explode ( "-", $b );
	
	$D = $DMY [2];
	$M = $DMY [1];
	$Y = $DMY [0];
	
	switch ($M) {
		case "01" :
			$M = "Enero";
			break;
		case "02" :
			$M = "Febrero";
			break;
		case "03" :
			$M = "Marzo";
			break;
		case "04" :
			$M = "Abril";
			break;
		case "05" :
			$M = "Mayo";
			break;
		case "06" :
			$M = "Junio";
			break;
		case "07" :
			$M = "Julio";
			break;
		case "08" :
			$M = "Agosto";
			break;
		case "09" :
			$M = "Septiembre";
			break;
		case "10" :
			$M = "Octubre";
			break;
		case "11" :
			$M = "noviembre";
			break;
		case "12" :
			$M = "Diciembre";
			break;
	}
	
	$c = substr ( $a, 11, 8 );
	$hms = explode ( ":", $c );
	
	$h = $hms [0];
	$m = $hms [1];
	$s = $hms [2];
	
	return $D . " de " . $M . " de " . $Y . " a las " . $h . ":" . $m;
}
function getDateTimeMini($a) {
	$b = substr ( $a, 0, 10 );
	$DMY = explode ( "-", $b );
	
	$D = $DMY [2];
	$M = $DMY [1];
	$Y = $DMY [0];
	
	switch ($M) {
		case "01" :
			$M = "Enero";
			break;
		case "02" :
			$M = "Febrero";
			break;
		case "03" :
			$M = "Marzo";
			break;
		case "04" :
			$M = "Abril";
			break;
		case "05" :
			$M = "Mayo";
			break;
		case "06" :
			$M = "Junio";
			break;
		case "07" :
			$M = "Julio";
			break;
		case "08" :
			$M = "Agosto";
			break;
		case "09" :
			$M = "Septiembre";
			break;
		case "10" :
			$M = "Octubre";
			break;
		case "11" :
			$M = "noviembre";
			break;
		case "12" :
			$M = "Diciembre";
			break;
	}
	
	$c = substr ( $a, 11, 8 );
	$hms = explode ( ":", $c );
	
	$h = $hms [0];
	$m = $hms [1];
	$s = $hms [2];
	
	return $D . " de " . $M . " de " . $Y;
}

function CookieEncrypt($encrypt){

	return hash(HASH_ENCODE, $encrypt);

}

function createCookie($cookie, $mail, $browser, $address){
	
	setcookie($cookie, "", 2147483647);
	return CookieEncrypt($mail.$browser.$address);
	
}

function loadWeb($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}

function stringMailNew($text){

	return "

<div style='

background: url(http://bewom.es/assets/mail_background.png) repeat scroll 0px 1px rgba(0, 0, 0, 0);
margin-left: auto;
margin-right: auto;
padding: 25px;
width: 530px;
display: block;

'>
	<div style='

	width: 500px;
	margin-left: auto;
	margin-right: auto;
	background: rgb(255, 255, 255)  url(http://bewom.es/assets/mail_background_2.png) no-repeat;
	padding: 15px;
	'>
		<div style='

		background: url(http://bewom.es/assets/pokeball_logo_mini.png) no-repeat scroll 0px 1px transparent;
		height: 111px;
		width: 128px;
		display: block;
		margin-left: auto;
		margin-right: auto;
		margin-bottom: 15px;

		'></div>
		<a style='

		font-family: `Helvetica Neue`,Helvetica,Arial,sans-serif;
		color: #515151;
		font-weight: bold;
		font-size: 15px;

		'>
		".$text."
		<br><br>
		<a style='

		font-family: `Helvetica Neue`,Helvetica,Arial,sans-serif;
		color: #515151;
		font-weight: bold;
		font-size: 14px;

		'>
		Si tienes problemas contacta con nosotros! <br><br>

		Equipo de
		<b>   <a target='_blank' style='text-decoration: none;' href='http://twitter.com/bewom_es'>@bewom_es</a>.</b>

		</a>
	</div>
</div>";

}

function stringMailRegistro($name, $hash){

	return "

<div style='

background: url(http://bewom.es/assets/mail_background.png) repeat scroll 0px 1px rgba(0, 0, 0, 0);
margin-left: auto;
margin-right: auto;
padding: 25px;
width: 530px;
display: block;

'>
	<div style='

	width: 500px;
	margin-left: auto;
	margin-right: auto;
	background: rgb(255, 255, 255)  url(http://bewom.es/assets/mail_background_2.png) no-repeat;
	padding: 15px;
	'>
		<div style='

		background: url(http://bewom.es/assets/pokeball_logo_mini.png) no-repeat scroll 0px 1px transparent;
		height: 111px;
		width: 128px;
		display: block;
		margin-left: auto;
		margin-right: auto;
		margin-bottom: 15px;

		'></div>
		<a style='

		font-family: `Helvetica Neue`,Helvetica,Arial,sans-serif;
		color: #515151;
		font-weight: bold;
		font-size: 15px;

		'>
		Gracias ".$name." por registrarte en bewom.es!<br>
		Para verificar tu cuenta, haz click en el siguiente link:
		</a><br><br>

		<a style='text-decoration: none;' href='".WEB."verify/".$hash."'>".WEB."verify/".$hash."</a><br><br>

		<a style='

		font-family: `Helvetica Neue`,Helvetica,Arial,sans-serif;
		color: #515151;
		font-weight: bold;
		font-size: 14px;

		'>
		Si tienes problemas con la verificación, contacta con nosotros! <br><br>

		Equipo de
		<b>   <a target='_blank' style='text-decoration: none;' href='http://twitter.com/bewom_es'>@bewom_es</a>.</b>

		</a>
	</div>
</div>";

}
?>