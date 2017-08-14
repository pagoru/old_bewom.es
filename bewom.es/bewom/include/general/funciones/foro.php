<?php

function getTema($nameForo, $uuidPlayer){
	$result_foro = MysqlOpen("SELECT * FROM `foro_foros` WHERE `nombre`='$nameForo'");
	$row_foro = mysql_fetch_array($result_foro);
	
	$foro = new stdClass();
	$foro->nombre = $row_foro["nombre"];
	$foro->open = $row_foro["open"];
	$foro->icon = $row_foro["icon"];

	$result_tema = MysqlOpen("SELECT * FROM `foro_tema` WHERE `foro`='$nameForo' AND `nombre`='$uuidPlayer'");
	$row_tema = mysql_fetch_array($result_tema);
	
	$foro->temas = new stdClass();
	$foro->temas->indice = $row_tema["indice"];
	$foro->temas->nombre = $row_tema["nombre"];
	$foro->temas->user = getUser($row_tema["uuid"]);
	$foro->temas->fecha = $row_tema["fecha"];
	$foro->temas->visitas = $row_tema["visitas"];
	$foro->temas->fijado = $row_tema["fijado"];
	$foro->temas->open = $row_tema["open"];
	$foro->temas->icon = $row_tema["icon"];
	$foro->temas->foro = $row_tema["foro"];
	$foro->temas->texto = $row_tema["texto"];
	
	return $foro;
}

function getTemaFromIndex($index_tema){
	$result_tema = MysqlOpen("SELECT * FROM `foro_tema` WHERE `indice`='$index_tema'");
	$row_tema = mysql_fetch_array($result_tema);

	$temas = new stdClass();
	$temas->indice = $row_tema["indice"];
	$temas->nombre = $row_tema["nombre"];
	$temas->user = getUser($row_tema["uuid"]);
	$temas->fecha = $row_tema["fecha"];
	$temas->visitas = $row_tema["visitas"];
	$temas->fijado = $row_tema["fijado"];
	$temas->open = $row_tema["open"];
	$temas->icon = $row_tema["icon"];
	$temas->foro = $row_tema["foro"];
	$temas->texto = $row_tema["texto"];
	
	$result_respuestas = MysqlOpen("SELECT * FROM `foro_respuestas` ORDER BY fecha ASC");
	
	$k = 0;
	while($row_respuestas = mysql_fetch_array($result_respuestas)){
			
		if($row_respuestas["tema_indice"] == $temas->indice){
	
			$temas->respuestas[$k] = new stdClass();
			$temas->respuestas[$k]->indice = $row_respuestas["indice"];
			$temas->respuestas[$k]->tema_indice = $row_respuestas["tema_indice"];
			$temas->respuestas[$k]->texto = $row_respuestas["texto"];
			$temas->respuestas[$k]->user = getUser($row_respuestas["uuid"]);
			$temas->respuestas[$k]->fecha = $row_respuestas["fecha"];
			$temas->respuestas[$k]->orden = $k + 1;
				
			$k++;
		}
	
	}
	
	return $temas;
}

function getForos(){
	
	$result_foro = MysqlOpen("SELECT * FROM `foro_foros` ORDER BY orden ASC");
	
	$i = 0;
	while($row_foro = mysql_fetch_array($result_foro)){
		
		$foro[$i] = new stdClass();
		$foro[$i]->nombre = $row_foro["nombre"];
		$foro[$i]->open = $row_foro["open"];
		$foro[$i]->icon = $row_foro["icon"];
		
		$result_tema = MysqlOpen("SELECT * FROM `foro_tema` ORDER BY fecha DESC");
		
		$j = 0;
		while($row_tema = mysql_fetch_array($result_tema)){
			
			if($row_tema["foro"] == $foro[$i]->nombre){
				
				$foro[$i]->temas[$j] = new stdClass();
				$foro[$i]->temas[$j]->indice = $row_tema["indice"];
				$foro[$i]->temas[$j]->nombre = $row_tema["nombre"];
				$foro[$i]->temas[$j]->user = getUser($row_tema["uuid"]);
				$foro[$i]->temas[$j]->fecha = $row_tema["fecha"];
				$foro[$i]->temas[$j]->visitas = $row_tema["visitas"];
				$foro[$i]->temas[$j]->fijado = $row_tema["fijado"];
				$foro[$i]->temas[$j]->open = $row_tema["open"];
				$foro[$i]->temas[$j]->icon = $row_tema["icon"];
				$foro[$i]->temas[$j]->foro = $row_tema["foro"];
				$foro[$i]->temas[$j]->texto = $row_tema["texto"];
				$foro[$i]->temas[$j]->orden = 0;
				
				$result_respuestas = MysqlOpen("SELECT * FROM `foro_respuestas` ORDER BY fecha ASC");
				
				$k = 0;
				while($row_respuestas = mysql_fetch_array($result_respuestas)){
					
					if($row_respuestas["tema_indice"] == $foro[$i]->temas[$j]->indice){
						
						$foro[$i]->temas[$j]->respuestas[$k] = new stdClass();
						$foro[$i]->temas[$j]->respuestas[$k]->indice = $row_respuestas["indice"];
						$foro[$i]->temas[$j]->respuestas[$k]->tema_indice = $row_respuestas["tema_indice"];
						$foro[$i]->temas[$j]->respuestas[$k]->texto = $row_respuestas["texto"];
						$foro[$i]->temas[$j]->respuestas[$k]->user = getUser($row_respuestas["uuid"]);
						$foro[$i]->temas[$j]->respuestas[$k]->fecha = $row_respuestas["fecha"];
						$foro[$i]->temas[$j]->respuestas[$k]->orden = $k + 1;
							
						$k++;
					}
						
				}
				
				$j++;
			}
			
		}
		
		$i++;
		
	}
	
	return $foro;
	
}

function getCountForo(){

	$int = 0;

	foreach (getForos() as $a){
		$int++;
	}

	return $int;

}

function getCountTemas($Temas){
	
	$int = 0;
	
	foreach ($Temas as $a){
		$int++;
	}
	
	return $int;
	
}

function getCountPosts($Temas){

	$int = 0;

	foreach ($Temas as $a){
		foreach ($a->respuestas as $b){
			$int++;
		}
	}

	return $int;

}

function getAllLastTemas(){

	$result_tema = MysqlOpen("SELECT * FROM `foro_tema` ORDER BY fecha DESC");

	$a = 0;
	while($row_tema = mysql_fetch_array($result_tema)){
		
		$temas[$a] = new stdClass();
		$temas[$a]->indice = $row_tema["indice"];
		$temas[$a]->nombre = $row_tema["nombre"];
		$temas[$a]->user = getUser($row_tema["uuid"]);
		$temas[$a]->fecha = $row_tema["fecha"];
		$temas[$a]->visitas = $row_tema["visitas"];
		$temas[$a]->fijado = $row_tema["fijado"];
		$temas[$a]->open = $row_tema["open"];
		$temas[$a]->icon = $row_tema["icon"];
		$temas[$a]->foro = $row_tema["foro"];
		$temas[$a]->texto = $row_tema["texto"];
		
		if($a < 9){
			$a++;
		} else {
			break;
		}
	}
	
	return $temas;

}

function getAllLastRespuestas(){

	$result_respuestas = MysqlOpen("SELECT * FROM `foro_respuestas` ORDER BY fecha DESC");
	
	$a = 0;
	while($row_respuestas = mysql_fetch_array($result_respuestas)){

		$respuestas[$a] = new stdClass();
		$respuestas[$a]->indice = $row_respuestas["indice"];
		$respuestas[$a]->texto = $row_respuestas["texto"];
		$respuestas[$a]->tema_indice = $row_respuestas["tema_indice"];
		$respuestas[$a]->user = getUser($row_respuestas["uuid"]);
		$respuestas[$a]->fecha = $row_respuestas["fecha"];
		$respuestas[$a]->tema = getTemaFromIndex($respuestas[$a]->tema_indice);
		
		if($a < 9){
			$a++;
		} else {
			break;
		}

	}

	return $respuestas;

}

function getAllLastRespuestasFromForum($forum){

	$result_respuestas = MysqlOpen("SELECT * FROM `foro_respuestas` ORDER BY fecha DESC");

	$a = 0;
	while($row_respuestas = mysql_fetch_array($result_respuestas)){
	
		if(getTemaFromIndex($row_respuestas["tema_indice"])->foro == $forum){
			$respuestas[$a] = new stdClass();
			$respuestas[$a]->indice = $row_respuestas["indice"];
			$respuestas[$a]->texto = $row_respuestas["texto"];
			$respuestas[$a]->tema_indice = $row_respuestas["tema_indice"];
			$respuestas[$a]->user = getUser($row_respuestas["uuid"]);
			$respuestas[$a]->fecha = $row_respuestas["fecha"];
			$respuestas[$a]->tema = getTemaFromIndex($respuestas[$a]->tema_indice);
			
			if($a < 9){
				$a++;
			} else {
				break;
			}
		}

	}

	return $respuestas;

}

function getLastRespuesta($Foro){
	
	$result_respuestas = MysqlOpen("SELECT * FROM `foro_respuestas` ORDER BY fecha DESC");
	$row_respuestas = mysql_fetch_array($result_respuestas);
	
	$result_temas = MysqlOpen("SELECT * FROM `foro_tema`");
	
	while($row_temas = mysql_fetch_array($result_temas)){
		
		$respuestas = new stdClass();
		
		if($Foro->nombre == $row_temas["foro"]){
			
			if(empty($row_respuestas["indice"])){
				
				$respuestas->indice = $row_temas["indice"];
				$respuestas->tema_indice = $row_temas["tema_indice"];
				$respuestas->user = getUser($row_temas["uuid"]);
				$respuestas->fecha = $row_temas["fecha"];
				
			} else {
				
				$respuestas->indice = $row_respuestas["indice"];
				$respuestas->tema_indice = $row_respuestas["tema_indice"];
				$respuestas->user = getUser($row_respuestas["uuid"]);
				$respuestas->fecha = $row_respuestas["fecha"];
				
			}			
			
		}
		
	}
	
	return $respuestas;

	
}

function getLastTema($Foro){
	
	$result_temas = MysqlOpen("SELECT * FROM `foro_tema` ORDER BY fecha DESC");
	
	$temas = new stdClass();
	
	while($row_temas = mysql_fetch_array($result_temas)){
		
		if($Foro->nombre == $row_temas["foro"]){
			
			$temas->indice = $row_temas["indice"];
			$temas->nombre = $row_temas["nombre"];
			$temas->user = getUser($row_temas["uuid"]);
			$temas->fecha = $row_temas["fecha"];
			return $temas;
			
		}
		
	}

}

function getCountRespuestas($Tema){

	$int = 0;

	foreach ($Tema->respuestas as $a){
		$int++;
	}

	return $int;

}

function getLastRespuestaTema($Tema){

	$i = 0;
	foreach ($Tema->respuestas as $c){
		$respuestas[$i] = $c;
		$i++;
	}
	if(empty($respuestas[$i-1])){
		
		return $Tema;
		
	} else {
		
		return $respuestas[$i-1];
		
	}

}

function cmp($a, $b){
	return strcmp($a->Fecha, $b->Fecha);
}

function getLastRespuestas($user){
	
	$foro = getForos();
	$aa = 0;
	
	foreach ($foro as $foroI){
		
		foreach ($foroI->temas as $temas){
			
			foreach ($temas->respuestas as $respuestas){
				
				if($respuestas->user->name == $user->name){
					
					$all[$aa] = new stdClass();
					$all[$aa]->ForoNombre = $foroI->nombre;
					$all[$aa]->TemaNombre = $temas->nombre;
					$all[$aa]->TemaIndice = $temas->indice;
					$all[$aa]->TemaOpen = $temas->open;
					$all[$aa]->Icon = $temas->icon;
					$all[$aa]->Texto = $respuestas->texto;
					$all[$aa]->User = $respuestas->user;
					$all[$aa]->Fecha = $respuestas->fecha;
					
					$aa++;
					
				}
				
			}
			
		}
		
	}
	
	return $all;
	
}

function getLastTemas($user){

	$foro = getForos();
	$aa = 0;

	foreach ($foro as $foroI){

		foreach ($foroI->temas as $temas){
				
			if($temas->user->name == $user->name){
	
				$all[$aa] = new stdClass();
				$all[$aa]->ForoNombre = $foroI->nombre;
				$all[$aa]->TemaNombre = $temas->nombre;
				$all[$aa]->TemaIndice = $temas->indice;
				$all[$aa]->TemaOpen = $temas->open;
				$all[$aa]->Icon = $temas->icon;
				$all[$aa]->Texto = $temas->texto;
				$all[$aa]->User = $temas->user;
				$all[$aa]->Fecha = $temas->fecha;
			
				$aa++;
			
			}
				
		}

	}

	usort($all, "cmp");

	return $all;

}

//create new things

function createNewForo($icon, $name, $open){
	
	MysqlOpen("INSERT INTO `foro_foros`(`nombre`, `open`, `icon`) VALUES ('$name', '$open', '$icon')");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";
	
}

function createNewTema($icon, $name, $uuid, $fixed, $open, $text, $foro){

	$text = nl2br($text);
	MysqlOpen("INSERT INTO `foro_tema`(`foro`, `nombre`, `uuid`, `fijado`, `open`, `icon`, `texto`) VALUES ('$foro','$name','$uuid','$fixed','$open','$icon','$text')");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";
	
}

function createNewRespuesta($uuid, $text, $tema){

	$text = nl2br($text);
	MysqlOpen("INSERT INTO `foro_respuestas`(`tema_indice`, `texto`, `uuid`) VALUES ('$tema', '$text', '$uuid')");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

//delete things

function deleteForo($name){

	MysqlOpen("DELETE FROM `foro_foros` WHERE `nombre`='$name'");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

function deleteTema($indice){

	MysqlOpen("DELETE FROM `foro_tema` WHERE `indice`='$indice'");
	MysqlOpen("DELETE FROM `foro_respuestas` WHERE `tema_indice`='$indice'");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

function deleteRespuesta($indice){

	MysqlOpen("DELETE FROM `foro_respuestas` WHERE `indice`='$indice'");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

//edit things

function editForo($newName, $name, $open, $icon){
	
	MysqlOpen("UPDATE `foro_tema` SET `foro`='$newName' WHERE `foro`='$name'");
	MysqlOpen("UPDATE `foro_foros` SET `nombre`='$newName',`open`='$open',`icon`='$icon' WHERE `nombre`='$name'");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

function editTema($indice, $foroName, $icon, $newName, $open, $fixed){
	
	MysqlOpen("UPDATE `foro_tema` SET `foro`='$foroName',`nombre`='$newName',`fijado`='$fixed',`open`='$open',`icon`='$icon' WHERE `indice`='$indice'");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

function editTemaText($indice, $text){

	$text = nl2br($text);
	MysqlOpen("UPDATE `foro_tema` SET `texto`='$text' WHERE `indice`='$indice'");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

function editRespuesta($indice, $text){

	$text = nl2br($text);
	MysqlOpen("UPDATE `foro_respuestas` SET `texto`='$text' WHERE `indice`='$indice'");
	$web = $_SERVER['REQUEST_URI'];
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; /redirect".$web."'>";

}

function inscribirTorneo(){
	
	if(getCurrentUser()->points >= 0 && getCurrentUser()->type != "admin"){
		$in = getCountTorneos();
		$result = MysqlOpen("SELECT * FROM `torneos` WHERE `index`='$in'");
		$row = mysql_fetch_array($result);
		
		$index = 0;
		$inscrito = false;
		$players = split(",", $row["playersName"]);
		for ($i = 0; $i < 16; $i++) {
			if(getCurrentUser()->name == $players[$i]){
				$inscrito = true;
				break;
			}
			if(empty($players[$i])){
				break;
			}
			$index++;
		}
		if(!$inscrito){
			if($index != 16){
				$players[$index] = getCurrentUser()->name;
				$playersName = "";
				for ($j = 0; $j < 16; $j++) {
					$playersName = $playersName.$players[$j];
					if($j != 15){
						$playersName = $playersName.",";
					}
				}
				echo $playersName;
				MysqlOpen("UPDATE `torneos` SET `playersName`='$playersName' WHERE `index`='$in'");
			}
		}
		
		$web = "http://bewom.es/torneos";
		echo "<META HTTP-EQUIV='refresh' CONTENT='0; ".$web."'>";
	}
}


function getLastNoticias(){

	$result_tema = MysqlOpen("SELECT * FROM `foro_tema` WHERE `foro`='Noticias' ORDER BY fecha DESC");

	$j = 0;
	while($row_tema = mysql_fetch_array($result_tema)){
		
		$tema[$j] = new stdClass();
		$tema[$j]->indice = $row_tema["indice"];
		$tema[$j]->nombre = $row_tema["nombre"];
		$tema[$j]->user = getUser($row_tema["uuid"]);
		$tema[$j]->fecha = $row_tema["fecha"];
		$tema[$j]->open = $row_tema["open"];
		$tema[$j]->icon = $row_tema["icon"];
		$tema[$j]->texto = $row_tema["texto"];
		
		$j++;
		
		if($j == 5){
			break;
		}
			
	}

	return $tema;

}

?>