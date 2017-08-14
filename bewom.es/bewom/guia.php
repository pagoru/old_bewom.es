<?php 
include 'include/general/functions.php';
include 'include/general/guia.php';
include 'include/general/cabecera.php';

// error_reporting(E_ALL);
// ini_set("display_errors", true);

if(!isValidSession()):
echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
?>
<style>
.open{
	color: #CF3232;
	background-color: #fff;
	padding: 8px;
	border-bottom: 2px solid #808080;
	font-weight: bold;
	margin-bottom: 4px;
}
.open a{
	cursor: pointer;
}
.content{
	padding: 8px;
    font-weight: normal;
    color: #454545;
    font-size: 14px;
}
h3 {
	margin-bottom: 4px;
}
img {
    max-width: 300px;
    max-height: 300px;
    margin: 4px;
    box-shadow: 4px 4px 0px 0px #454545;
}
.guia{
	background: #CF3232 url("assets/guia.png") no-repeat scroll 314px 0%;
	background-color: #CF3232;
	border-bottom: 2px solid #808080;
	height: 96px;
	width: 100%;
	margin-top: 4px;
	margin-bottom: 4px;
	text-align: center;
	vertical-align: middle;
	font-size: 32px;
	color: rgb(255, 255, 255);
	line-height: 96px;
	font-weight: bold;
	letter-spacing: -2px;
	text-shadow: 2px 2px 4px #333;
}
</style>
<body>
<div id="barebone">
	<div id="page">
		<div class="guia">
			LA GUIA DE PIXELMON PARA BEWOM
		</div>
		<h3>Primeros pasos en el servidor</h3>
		<?php for ($i = 0; $i < getGuia()->firstCount; $i++): ?>
		<div class="open"><a id="<?php echo $i;?>"><?php echo getGuia()->first[$i]->pregunta;?></a>
			<div class="content" id="div<?php echo $i;?>"><?php echo nl2br(getGuia()->first[$i]->respuesta);?></div>
		</div>
		<?php endfor; ?>
		<h3>Mas allá</h3>
		<h3>Mucho mas allá</h3>
</div>

<script>
<?php for ($i = 0; $i < getGuia()->firstCount; $i++): ?>
$('#div<?php echo $i?>').hide();
$('#<?php echo $i?>').click(function(){
	$('#div<?php echo $i?>').slideToggle(150);
});
<?php endfor;?>
</script>

</body>
<?php include 'include/general/footer.php';?>
<?php endif;?>