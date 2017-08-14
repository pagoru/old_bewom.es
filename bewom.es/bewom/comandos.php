<?php
include 'include/general/functions.php';
include 'include/general/cabecera.php';

if(!isValidSession()):
echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
?>
<body>

<div id="barebone">
	<div id="page">
		<h2><center>Comandos del servidor</center></h2>
		<hr>
		<div id="ins">
			<?php include 'include/general/comandos.php';?>
		</div>
	</div>
</div>

</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>