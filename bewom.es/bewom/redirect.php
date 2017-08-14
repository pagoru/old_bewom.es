<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

if(!isValidSession()):
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
$web = $_GET["param"];
echo "<META HTTP-EQUIV='refresh' CONTENT='0; http://bewom.es/".$web."'>";
?>
<style>
#insidePage{
	background: #DFDFDF url("/assets/pikachu_carga.gif") no-repeat scroll 50% 50%;
	padding: 40px;
}
</style>
<body>

<div id="barebone">
	<div id="page">
		<div id="insidePage">
		<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		</div>
	</div>
</div>

</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>