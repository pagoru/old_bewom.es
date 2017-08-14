<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

if(!isValidSession()):
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
$inputParams 	= $_GET["p"];
$p 				= explode("/", $inputParams);

// echo "<META HTTP-EQUIV='refresh' CONTENT='0; http://bewom.es/".$web."'>";
?>
<style>
#insidePage{
	background: #DFDFDF url("/assets/pikachu_carga.gif") no-repeat scroll 50% 50%/300px auto;
	padding: 40px;
}
</style>
<body>

<div id="barebone">
	<div id="page">
		<?php 
		
		$foroForo = "foro";
		$redirect = WEB.$foroForo."/";
		
		$t = substr(getCurrentUser()->type, 0, 1);
		
		if($p[3] == $t){ //Comprobar si el usuario tiene el rango correcto
			
			if($p[0] == "r"){ //modo switch //respuesta
					
				if(isTema($p[1], $p[2])){ //Comprobar si el tema es correcto en el foro
					
					$icon 	= $_POST["icon"];
					$open 	= $_POST["open"];
					$fijado = $_POST["fijado"];
					$title 	= $_POST["title"];
					$text 	= $_POST["text"];
					
					$lastForo = getCurrentUser()->lastForo;
					if($lastForo != $text){
												
						if($t == "a"){ //Si es administrador.
							
							createRespuestaAdmin_($icon, $open, $fijado, $title, $text, $p[1]);
						
						} else {
							
							createRespuesta_($text, $p[1]);
							
						}
						
					}
					
					$redirect = WEB.$foroForo."/".$p[2]."/".$p[1]."/";
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; ".$redirect."'>";
			
				}
					
			} else if($p[0] == "t"){ //modo switch //tema
				
				if(isForo($p[1])){ //Comprobar si el foro existe
					
					$icon 	= $_POST["icon"];
					$open 	= $_POST["open"];
					$fijado = $_POST["fijado"];
					$title 	= $_POST["title"];
					$text 	= $_POST["text"];
					
					$lastForo = getCurrentUser()->lastForo;
					if($lastForo != $text){
						
						if($t == "a"){ //Si es administrador.
							
							createTemaAdmin_($icon, $open, $fijado, $title, $text, $p[1]);
							
						} else {
							
							createTema_($icon, $title, $text, $p[1]);
							
						}
						
						$indice = getLastTemaFromUser_()->indice;
						
						$redirect = WEB.$foroForo."/".$p[1]."/".$indice."/";
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; ".$redirect."'>";
							
					}
					
				}
				
			} else if($p[0] == "t_m"){ //modo switch //tema_modificar
				
				if($t == "a"){ //Si es administrador.
					
					if(isTema($p[1], $p[2])){ //Comprobar si el tema es correcto en el foro
							
						$icon 	= $_POST["icon"];
						$open 	= $_POST["open"];
						$fijado = $_POST["fijado"];
						$title 	= $_POST["title"];
						$text 	= $_POST["text"];
						
						modifyTemaAdmin_($p[1], $icon, $open, $fijado, $title, $text, $p[2]);
						
						$redirect = WEB.$foroForo."/".$p[2]."/".$p[1]."/";
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; ".$redirect."'>";
							
					}
					
				}
				
			}  else if($p[0] == "r_m"){ //modo switch //respuesta_modificar
				
				if($t == "a"){ //Si es administrador.
					
					$pp = explode("-", $p[1]);
					
					if(isTema($pp[1], $p[2])){ //Comprobar si el tema es correcto en el foro
							
						$text 	= $_POST["text"];
						
						modifyRespuestaAdmin_($pp[0], $text);
					
						$redirect = WEB.$foroForo."/".$p[2]."/".$pp[1]."/";
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; ".$redirect."'>";
							
					}
					
				}
				
			}  else if($p[0] == "r_d"){ //modo switch //respuesta_eliminar
				
				if($t == "a"){ //Si es administrador.
					
					$pp = explode("-", $p[1]);
					
					if(isTema($pp[1], $p[2])){ //Comprobar si el tema es correcto en el foro
					
						deleteRespuestaAdmin_($pp[0]);
						
						$redirect = WEB.$foroForo."/".$p[2]."/".$pp[1]."/";
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; ".$redirect."'>";
					
					}
					
				}
				
			}  else if($p[0] == "t_d"){ //modo switch //tema_eliminar
				
				if($t == "a"){ //Si es administrador.
										
					if(isTema($p[1], $p[2])){ //Comprobar si el tema es correcto en el foro
					
						deleteTemaAdmin_($p[1]);
						
						$redirect = WEB.$foroForo."/".$p[2]."/";
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; ".$redirect."'>";
					
					}
					
				}
				
			}
			
		}
		
		echo "<META HTTP-EQUIV='refresh' CONTENT='1; ".$redirect."'>";
		
		?>
		<div id="insidePage">
		<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		</div>
	</div>
</div>

</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>