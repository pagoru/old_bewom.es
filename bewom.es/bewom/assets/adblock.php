<!-- Desarrollado 100% por @pablogoru (Darkaqua) 2015 ! -->


<!-- // Cabecera pgdk (bewom.es) // -->
<?php 
session_start();
header('Content-Type: text/html; charset=UTF-8');

include 'include/general/functions.php';

?>

<head>
	<title>bewom pixelmon</title>
	<link rel="shortcut icon" href="../assets/icon.ico">
	<style>
		<?php include "./css/style.css";?>
		<?php include "./css/style_profile.css";?>
		
		img{
			width: 100%;
			margin-top: -80px;
			margin-bottom: -80px;
		}
		<?php if(getCurrentUser()->type == "admin"):?>
		header a:hover{
			background-color: #333;
		}
		
		header, #header_info, #header_menu_profile{
			background-color: #000;
		}
		
		<?php elseif(getCurrentUser()->type == "vip"):?>
		header a:hover{
			background-color: #007a7a;
		}
		
		header, #header_info, #header_menu_profile{
			background-color: #00AAAA;
		}
		<?php else:?>
		header a:hover{
			background-color: #ad2a2a;
		}
		
		header, #header_info, #header_menu_profile{
			background-color: #CF3232;
		}
		
		<?php endif;?>
	</style>
</head>

<header>
	<div id="header_logo"></div>
	<div id="header_select">
		<a href="<?php echo "http://".substr($_GET['param1'], 6);?>">Volver a la web...</a> 
	</div>
</header>
<!-- // FIN Cabecera pgdk (bewom.es) // -->

<body>

<div id="barebone">
	<div id="page">
		<h2><center>¡Usas adblock! :'(</center></h2>
		<hr>
		<div id="insideDiv">
		¡Usas adblock y eso no nos gusta! :( <br>
		¡Si quieres deshabilitar los anuncios, haz una donación! :) <br><br>
		El servidor no se mantiene del aire y esos pocos links que te pueden aparecer de publicidad nos ayudan a mantener el servidor y posiblemente bajar el mínimo para ser vip.
		Si tuviesemos ingresos ilimitados, no nos veriamos en esta situaci�n... comprendenos!<br><br>
		Cuando recapacites y estes listo, vuelve a la web... esta vez sin adblock, o nos volveremos a ver las caras. >:(
		
		</div>
		
		<img src="/assets/ad.png">
		
	</div>
</div>

</body>
<?php include 'include/general/footer.php';?>