<?php

function sumaVisitasTema($indice) { //Incrementa las visitas del tema
	
	$result_tema = MysqlOpen("SELECT * FROM `foro_tema` WHERE `indice`='$indice'");
	$row_tema = mysql_fetch_array($result_tema);

	$visitas = $row_tema["visitas"] + 1;
	
	MysqlOpen ( "UPDATE `foro_tema` SET `visitas`='$visitas' WHERE `indice`='$indice'" );
}

function getTituloReclamaciones($titulo){ //Devolver el nombre de usuario si el título contiene la uuid ** ATENCIÓN ** Si en cualquier publicación se pone una uuid registrada, se activará.
	
	$user = getUser($titulo);
	
	if(!empty($user->name)){
		
		return "Expulsión de ".$user->name;
		
	}
	
	return $titulo;
	
}

function getForo_($nameForo){
	
	$result_foro = MysqlOpen("SELECT * FROM `foro_foros` WHERE `nombre`='$nameForo'");
	$row_foro = mysql_fetch_array($result_foro);
	
	$foro 				= new stdClass();
	$foro->nombre 		= $row_foro["nombre"];
	$foro->descripcion 	= $row_foro["descripcion"];
	$foro->open 		= $row_foro["open"];
	$foro->icon 		= $row_foro["icon"];
		
	return $foro;
	
}

function getTema_($indexTema){
	
	$result_tema = MysqlOpen("SELECT * FROM `foro_tema` WHERE `indice`='$indexTema'");
	$row_tema = mysql_fetch_array($result_tema);
	
	$tema 				= new stdClass();
	$tema->indice 		= $row_tema["indice"];
	$tema->nombre 		= getTituloReclamaciones($row_tema["nombre"]);
	$tema->user 		= getUser($row_tema["uuid"]);
	$tema->fecha 		= $row_tema["fecha"];
	$tema->visitas 		= $row_tema["visitas"];
	$tema->fijado 		= $row_tema["fijado"];
	$tema->open 		= $row_tema["open"];
	$tema->icon 		= $row_tema["icon"];
	$tema->foro 		= $row_tema["foro"];
	$tema->texto 		= $row_tema["texto"];
	
	$result_respuestas = MysqlOpen("SELECT * FROM `foro_respuestas` WHERE `tema_indice`='$indexTema' ORDER BY fecha ASC");
	
	$k = 0;
	while($row_respuestas = mysql_fetch_array($result_respuestas)){
			
		$tema->respuestas[$k] 				= new stdClass();
		$tema->respuestas[$k]->indice 		= $row_respuestas["indice"];
		$tema->respuestas[$k]->tema_indice 	= $row_respuestas["tema_indice"];
		$tema->respuestas[$k]->texto 		= $row_respuestas["texto"];
		$tema->respuestas[$k]->user 		= getUser($row_respuestas["uuid"]);
		$tema->respuestas[$k]->fecha 		= $row_respuestas["fecha"];
		$tema->respuestas[$k]->orden 		= $k + 1;
			
		$k++;
	
	}
	
	return $tema;
	
}

function getLastRespuestaFecha($indexTema){
	
	$result = MysqlOpen("SELECT * FROM `foro_respuestas` WHERE `tema_indice`='$indexTema' ORDER BY fecha DESC");
	
	while($row = mysql_fetch_array($result)){
		
		return $row["fecha"];
		
	}
	
	return mysql_fetch_array(MysqlOpen("SELECT * FROM `foro_tema` WHERE `indice`='$indexTema' ORDER BY fecha DESC"))["fecha"];
	
}

function getTemas_($nameForo){ //Devuelve todos los temas de un foro.
	
	$result_temas = MysqlOpen("SELECT * FROM `foro_tema` WHERE `foro`='$nameForo' ORDER BY fecha DESC");
	
	$i = 0;
	while($row_temas = mysql_fetch_array($result_temas)){
	
		$temas[$i] 				= new stdClass();
		$temas[$i]->indice 		= $row_temas["indice"];
		$temas[$i]->nombre 		= getTituloReclamaciones($row_temas["nombre"]);
		$temas[$i]->user 		= getUser($row_temas["uuid"]);
		$temas[$i]->fecha 		= $row_temas["fecha"];
		$temas[$i]->visitas 	= $row_temas["visitas"];
		$temas[$i]->fijado	 	= $row_temas["fijado"];
		$temas[$i]->open 		= $row_temas["open"]; 
		$temas[$i]->icon		= $row_temas["icon"];
		
		$indice = $temas[$i]->indice;
		
		$temas[$i]->replicas	= mysql_fetch_array(MysqlOpen("SELECT COUNT(indice) AS count FROM `foro_respuestas` WHERE `tema_indice`='$indice'"))["count"];
		$temas[$i]->lastReplica	= getLastRespuestaFecha($indice);
		
		$i++;
		
	}
	
	$j = 0;
	foreach($temas as $t){
		
		if($t->fijado){
			$tema[$j] = $t;
			$j++;
		}
		
	}
	$k = 0;
	foreach($temas as $t){
	
		if(!$t->fijado){
			$tema_non_fix[$k] = $t;
			$k++;
		}
	
	}
	
	function compareItems($a, $b){
		if ( $a->lastReplica > $b->lastReplica ) return -1;
		if ( $a->lastReplica < $b->lastReplica ) return 1;
		return 0; // equality
	}
	
	uasort($tema_non_fix, "compareItems");
	
	foreach($tema_non_fix as $t){
	
		$tema[$j] = $t;
		$j++;
	
	}
	
	return $tema;
	
}

function getDateFromCurrent($date){ //Restar fechas y devolver cuanto tiempo ha pasado
	
	$datetime1 = new DateTime($date);
	$datetime2 = new DateTime();
	
	$interval = $datetime1->diff($datetime2);
	
	$dias 		= $interval->format('%a');
	$horas 		= $interval->format('%h');
	$minutos 	= $interval->format('%i');
	$segundos 	= $interval->format('%s');
	
	if($dias == "0"){
		if($horas == "0"){
			if($minutos == "0"){
				return $segundos."s";
			}
			return $minutos." m";
		}
		return $horas."h";
	}
	return $dias."d";
	
}

function compareItemsFecha($a, $b){
	if ( $a->fecha > $b->fecha ) return -1;
	if ( $a->fecha < $b->fecha ) return 1;
	return 0; // equality
}

function getLastTemas_($nameForo){ //Devolver ultimos 3 temas de un foro
	
	$result_temas = MysqlOpen("SELECT * FROM `foro_tema` WHERE `foro`='$nameForo' ORDER BY fecha DESC");
		
	$i = 0;
	while($row_temas = mysql_fetch_array($result_temas)){
		
		$indice 				= $row_temas["indice"];
		
		$tema[$i] 				= new stdClass();
		$tema[$i]->indice 		= $indice;
		$tema[$i]->nombre 		= getTituloReclamaciones($row_temas["nombre"]);
		
		$tema[$i]->fecha 		= getLastRespuestaFecha($indice);
		$i++;
		
		if($i == 3){
			break;
		}
		
	}
	
	uasort($tema, "compareItemsFecha");
	
	foreach($tema as $t){
	
		$temas[$j] = $t;
		$j++;
	
	}
	
	return $temas;
	
}

function getLastTemaFromUser_(){ //Devolver ultimo tema de un usuario
	
	$uuid = getCurrentUser()->uuid;
	
	$result_temas = MysqlOpen("SELECT * FROM `foro_tema` WHERE `uuid`='$uuid' ORDER BY fecha DESC");
	
	while($row_tema = mysql_fetch_array($result_temas)){
	
		return getTema_($row_tema['indice']);
	
	}
	
	return null;

}

function getForos_(){ //Recoge los foros
	
	$result_foro = MysqlOpen("SELECT * FROM `foro_foros` ORDER BY orden ASC");
	
	$i = 0;
	while($row_foro = mysql_fetch_array($result_foro)){
	
		$foro[$i] 				= new stdClass();
		$foro[$i]->nombre 		= $row_foro["nombre"];
		$foro[$i]->descripcion 	= $row_foro["descripcion"];
		$foro[$i]->open 		= $row_foro["open"];
		$foro[$i]->icon 		= $row_foro["icon"];
		
		$name = $foro[$i]->nombre;
		$foro[$i]->numTemas		= mysql_fetch_array(MysqlOpen("SELECT COUNT(foro) AS count FROM `foro_tema` WHERE `foro`='$name'"))["count"];
		
		$i++;
		
	}
	
	return $foro;
	
}

function isTema($indexTema, $nameForo){ //Comprobar si el tema existe y es del mismo foro
	
	$result_tema 	= MysqlOpen("SELECT * FROM `foro_tema` WHERE `indice`='$indexTema'");
	$row_tema 		= mysql_fetch_array($result_tema);
	
	if(!empty($row_tema["nombre"]) && $row_tema["foro"] == $nameForo){
		return true;
	}
	
	return false;
	
}

function isForo($nameForo){ //Comprobar si el foro es real o no.
	
	$result_foro = MysqlOpen("SELECT * FROM `foro_foros` WHERE `nombre`='$nameForo'");
	$row_foro = mysql_fetch_array($result_foro);
	
	if(!empty($row_foro["nombre"])){
		return true;
	}
	
	return false;
	
}

function error404(){ //devolver error 404
	
	return "<meta http-equiv='refresh' content='0; url=".WEB."404' />";
// 	return "error";
	
}

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

function createRespuesta_($text, $tema){

	$text = nl2br($text);
	$uuid = getCurrentUser()->uuid;
	
	MysqlOpen("UPDATE `users` SET `lastForo`='$text' WHERE `uuid`='$uuid'" );
	MysqlOpen("INSERT INTO `foro_respuestas`(`tema_indice`, `texto`, `uuid`) VALUES ('$tema', '$text', '$uuid')");

}

function createTema_($icon, $title, $text, $foro){

	$text = nl2br($text);
	$uuid = getCurrentUser()->uuid;

	MysqlOpen("UPDATE `users` SET `lastForo`='$text' WHERE `uuid`='$uuid'" );

	MysqlOpen("INSERT INTO `foro_tema`(`foro`, `nombre`, `uuid`, `fijado`, `open`, `icon`, `texto`) VALUES ('$foro','$title','$uuid','0','1','$icon','$text')");

}

function createRespuestaAdmin_($icon, $open, $fijado, $title, $text, $tema){

	$text = nl2br($text);
	$uuid = getCurrentUser()->uuid;
	
	MysqlOpen("UPDATE `foro_tema` SET `icon`='$icon', `open`='$open', `fijado`='$fijado', `nombre`='$title' WHERE `indice`='$tema'");
	
	MysqlOpen("UPDATE `users` SET `lastForo`='$text' WHERE `uuid`='$uuid'" );
	MysqlOpen("INSERT INTO `foro_respuestas`(`tema_indice`, `texto`, `uuid`) VALUES ('$tema', '$text', '$uuid')");

}

function createTemaAdmin_($icon, $open, $fijado, $title, $text, $foro){

	$text = nl2br($text);
	$uuid = getCurrentUser()->uuid;

	MysqlOpen("UPDATE `users` SET `lastForo`='$text' WHERE `uuid`='$uuid'" );
	
	MysqlOpen("INSERT INTO `foro_tema`(`foro`, `nombre`, `uuid`, `fijado`, `open`, `icon`, `texto`) VALUES ('$foro','$title','$uuid','$fijado','$open','$icon','$text')");

}

//////////////////////////////////


function modifyTemaAdmin_($tema, $icon, $open, $fijado, $title, $text, $foro){

	$text = nl2br($text);
	$uuid = getCurrentUser()->uuid;

	MysqlOpen("UPDATE `foro_tema` SET `foro`='$foro', `nombre`='$title', `uuid`='$uuid', `fijado`='$fijado', `open`='$open', `icon`='$icon', `texto`='$text' WHERE `indice`='$tema'");

}

function modifyRespuestaAdmin_($respuesta, $text){

	$text = nl2br($text);

	MysqlOpen("UPDATE `foro_respuestas` SET `texto`='$text' WHERE `indice`='$respuesta'");

}

function deleteRespuestaAdmin_($respuesta){

	MysqlOpen("DELETE FROM `foro_respuestas` WHERE `indice`='$respuesta'");

}

function deleteTemaAdmin_($tema){
	
	MysqlOpen("DELETE FROM `foro_tema` WHERE `indice`='$tema'");
	MysqlOpen("DELETE FROM `foro_respuestas` WHERE `tema_indice`='$tema'");

}


?>