<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

if(!isValidSession()):
echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
echo "<META HTTP-EQUIV='refresh' CONTENT='3;".WEB."'>";
?>

<style>
<?php include "css/style.css";?>

#ccc{
	font-size: 560px;
	font-weight: bold;
	letter-spacing: -27px;
	margin-top: -100px;
	text-shadow: 3px 3px 0px #BFBFBF;
	color: #FFF;
	margin-bottom: -104px;
}
</style>

<body>

<div id="barebone">
	<div id="page" style="height: 370px;">
	
		<div id="ccc">404</div>
		
	</div>
</div>

</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>