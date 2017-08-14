<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

$param1 = $_GET["param1"];

if(!isValidSession()):
echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
?>
<style>
	<?php include "./css/style_normas.css";?>
</style>
<body>

<div id="barebone">
	<div id="page">
		<?php if($param1 == "top"):?>
		<h2><center>Top jugadores</center></h2>
		<hr>
		<div id="insideDiv" style="display: table-cell;">
		<?php include 'include/torneos/top_jugadores.php';?>
		</div>
		<?php else:?>
		<h2><center>Torneos</center></h2>
		<hr><br>
		<div id="insideDiv">
			<?php include 'include/torneos/torneos.php';?>
		</div>
		<?php endif;?>
	</div>
</div>

</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>