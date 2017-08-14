<?php
include 'include/general/functions.php';
$param = $_GET["p"];

$p = explode("/", $param);

$session = $p[0];
$consulta = $p[1];
$type = $p[2];

if($session == "UzjnGApn8bD3TWUV"){
	$result = MysqlOpen($consulta);
	while($row = mysql_fetch_array($result)){
		if($i > 0){
			echo ",";
		}
		echo $row[$type];
		$i++;
	}
} else if($session == "public"){
	
	$result = MysqlOpen("SELECT * FROM `users_ban` WHERE `uuid`='$consulta' AND `active`='1'");
	$row = mysql_fetch_array($result);
	
	$uuid = $row['uuid'];
	$perm = $row['perm'];
	$date = time() - strtotime($row['date']);
	$exp = $row['exp'] * 86400;
	$active = $row['active'];
	
	$expire = $exp - $date;
	
	$return = 0;
	
	if(!empty($active)){
		if($active){
			if($perm){
				$return = 1;
			} else {
				if($expire <= 0){
					$return = 0;
				} else {
					$return = 1;
				}
			}
		} else {
			$return = 0;
		}				
	} else {
		$return = 0;		
	}
	
	if($return == 0){
		MysqlOpen("UPDATE `users_ban` SET `active`='0' WHERE `uuid`='$consulta'");
	}
	
	echo $return;
} else if($session == "public_perms"){
	$result = MysqlOpen("SELECT * FROM `users` WHERE `uuid`='$consulta' OR `user`='$consulta'");
	$row = mysql_fetch_array($result);
	if(count($p) == 2){
		echo $row['type'];
	} else {
		if(empty($row['type'])){
			echo "null/".$p[2]."/".$p[3]."/".$p[4];
		} else {
			echo $row['type']."/".$p[2]."/".$p[3]."/".$p[4];
		}
	}
} else if($session == "ip"){
	echo mysql_fetch_array(MysqlOpen("SELECT `ip` FROM `config`"))["ip"];
} else if($session == "ping"){
	$ping = mysql_fetch_array(MysqlOpen("SELECT `lastPing` FROM `serverPing`"))["lastPing"];
	if((time() - $ping) > 120 && !empty($ping)){
		echo "0";
		MysqlOpen("DELETE FROM `PlayersOnLine`");
	} else {
		echo "1";
	}
} else if($session == "ping2"){
	echo "<meta http-equiv='refresh' content='1'>";
	echo time()."-". mysql_fetch_array(MysqlOpen("SELECT `lastPing` FROM `serverPing`"))["lastPing"];
	echo "<br/>".(time() - mysql_fetch_array(MysqlOpen("SELECT `lastPing` FROM `serverPing`"))["lastPing"])."-";
	$ping = mysql_fetch_array(MysqlOpen("SELECT `lastPing` FROM `serverPing`"))["lastPing"];
	if((time() - $ping) > 120 && !empty($ping)){
		echo "0";
		MysqlOpen("DELETE FROM `PlayersOnLine`");
	} else {
		echo "1";
	}
} else if($session == "players"){
	$result = MysqlOpen("SELECT `name` FROM `PlayersOnLine`");
	$count = mysql_num_rows($result);
	while($row = mysql_fetch_array($result)){
		$name = $row['name'];
		echo $name."?".mysql_fetch_array(MysqlOpen("SELECT `type` FROM `users` WHERE `user`='$name'"))["type"];
		if($count != 1){
			echo ",";
			$count--;
		}
	}
} else if($session == "firma"){
	$uuid = getCurrentUser()->uuid;
	if(getCurrentUser()->type != "miembro"){
		$firma = substr($param, 6);
		MysqlOpen("UPDATE `users` SET `firma`='$firma' WHERE `uuid`='$uuid'");
		echo bb_parse_firma($firma);
	} else {
		MysqlOpen("UPDATE `users` SET `firma`='' WHERE `uuid`='$uuid'");
	}
} else if($session == "firma_2"){
	$uuid = getCurrentUser()->uuid;
	if(getCurrentUser()->type != "miembro"){
		$firma = $_POST["p"];
		MysqlOpen("UPDATE `users` SET `firma`='$firma' WHERE `uuid`='$uuid'");
		echo bb_parse_firma($firma);
	} else {
		MysqlOpen("UPDATE `users` SET `firma`='' WHERE `uuid`='$uuid'");
	}
} else if($session == "foro_message"){
	$text = substr($param, 13);
	echo bb_parse($text, getCurrentUser()->type);
	
} else if($session == "foro_message_2"){
	echo bb_parse($_POST["p"]);
} else if($session == "cabecera"){
	$uuid = getCurrentUser()->uuid;
	if(getCurrentUser()->type != "miembro"){
		$cabecera = substr($param, 9);
		MysqlOpen("UPDATE `users` SET `cabecera`='$cabecera' WHERE `uuid`='$uuid'");
		echo $cabecera;
	}
} else if($session == "verifyPassword"){
	$uuid = getCurrentUser()->uuid;
	$consulta;
	$result = MysqlOpen("SELECT `password` FROM `users_info` WHERE `uuid`='$uuid'");
	$password = mysql_fetch_array($result)["password"];
	if(pass_verify($consulta, $password)){
		echo 1;
	} else {
		echo 0;
	}
} else if($session == "torneos"){
	$torn = new stdClass();
	$torn->nombre = mysql_fetch_array(MysqlOpen("SELECT * FROM `torneos` WHERE `index`='$consulta'"))["name"];
	$torn->date = mysql_fetch_array(MysqlOpen("SELECT * FROM `torneos` WHERE `index`='$consulta'"))["date"];
	$torn->maxPlayers = mysql_fetch_array(MysqlOpen("SELECT * FROM `torneos` WHERE `index`='$consulta'"))["maxPlayers"];
	$torn->players = mysql_fetch_array(MysqlOpen("SELECT * FROM `torneos` WHERE `index`='$consulta'"))["playersName"];
	$torn->round1 = mysql_fetch_array(MysqlOpen("SELECT * FROM `torneos` WHERE `index`='$consulta'"))["winsRound1"];
	$torn->round2 = mysql_fetch_array(MysqlOpen("SELECT * FROM `torneos` WHERE `index`='$consulta'"))["winsRound2"];
	$torn->round3 = mysql_fetch_array(MysqlOpen("SELECT * FROM `torneos` WHERE `index`='$consulta'"))["winsRound3"];
	$torn->round4 = mysql_fetch_array(MysqlOpen("SELECT * FROM `torneos` WHERE `index`='$consulta'"))["winsRound4"];
	
	echo $torn->nombre.";".$torn->date.";".$torn->maxPlayers.";";
	echo $torn->players.";".$torn->round1.";".$torn->round2.";".$torn->round3.";".$torn->round4;
} else if($session == "graphs"){
	$result = MysqlOpen("SELECT * FROM `serverUsage` ORDER BY `date` DESC");
	
	$i = 0;
	while($row = mysql_fetch_array($result)){
		echo $row["cpuUsage"]."-".$row["ramUsage"].",";
		if($i == 1000){
			break;
		}
		$i++;
	}
} else if($session == "usersGraph"){
	$result = MysqlOpen("SELECT * FROM `playersUsage` ORDER BY `date` ASC");
	
	$currentDay = date("d");
	$currentHour = date("H");
	
	while($row = mysql_fetch_array($result)){
		
		$day = substr($row["date"], 8, 2);
		$hour = substr($row["date"], 11, 2);
		
		if($day == $currentDay | $day == ($currentDay-1)){
			if(($currentDay == $day && $currentHour >= $hour) || ($currentDay-1 == $day && $currentHour < $hour)){
				$players[intval($hour)] += $row["players"];
				$current[intval($hour)]++;
			}
		}
		
	}
	
	for ($i = 0; $i < 24; $i++) {
		echo round($players[$i]/$current[$i]);
		
		if($i != 23){
			echo ",";
		}
	}
	
}
?>