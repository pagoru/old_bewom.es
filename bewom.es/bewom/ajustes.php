<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

if(!isValidSession()):
	echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:

if(isset($_POST["SubmitP"])){
	if($_POST["newPassword"] == $_POST["newRePassword"] && !empty($_POST["password"])){		
		$password = encrypt($_POST["newPassword"]);
		$uuid = getCurrentUser()->uuid;
		MysqlOpen("UPDATE `users_info` SET `password`='$password' WHERE `uuid`='$uuid'");
		unset($_POST);
	}
}

?>
<style>
<?php include "./css/style_foro.css";?>
	.creacion_box {
	    border: 1px solid #989898;
	    padding: 8px;
	    width: 616px;
	    margin-bottom: 4px;
	}
	.creacion_boton{
		border: 1px solid rgb(152, 152, 152);
		height: 34px;
		width: 616px;
		margin-bottom: 4px;
	    float: right;
	    background-color: #f0f0f0;
	}
	#send_textarea {
	    width: 388px;
		height: 128px;
		resize: none;
		padding: 8px;
		border: 1px solid #989898;
	}
	#columnLeft {
	    padding-right: 4px;
	    border-right: 2px solid #C3C3C3;
	    display: table-cell;
	    width: 248px;
	}
	#columnRight {
		display: table-cell;
	    width: 616px;
	    padding-left: 4px;
	    border-left: 2px solid #C3C3C3;
	}
	#firma {
	    background-color: #FFF;
		border-bottom: 4px solid #C3C3C3;
		border-top: 4px solid #C3C3C3;
		padding: 4px;
		margin-top: 4px;
		width: 380px
	}
	.buttonOptions {
		border-bottom: 4px solid #333;
		background-color: #C3C3C3;
		margin-top: 4px;
		padding: 4px;
		cursor: pointer;
	}
</style>
<body>

<div id="barebone">
	<div id="page">
		<h2><center>Ajustes</center></h2>
		<hr style="background-color: #C3C3C3;"><br>
		<div id="columnLeft">
		<hr style="margin-left: 0px; background-color: #454545;">
			<div id="buttonPas" class="buttonOptions"><h3><center>Contraseña</center></h3></div>
			<?php if(getCurrentUser()->type != "miembro"):?>
			<div id="buttonFir" class="buttonOptions"><h3><center>Firma</center></h3></div>
			<div id="buttonCab" class="buttonOptions"><h3><center>Cabecera</center></h3></div>
			<?php endif;?>
		</div>
		<div id="columnRight">
			<!-- contraseña -->
			<div id="ajustesPas">
				<center><h3>Cambiar contraseña</h3></center>
				<hr style="background-color: #C3C3C3;"><br>
				<form method="post" style="width: 100%; height: 100%; float: left;">
					<input id="p" type="password" class="creacion_box" name="password" placeholder="Contraseña actual"></input>
					<br><br>
					<input id="np" type="password" class="creacion_box" name="newPassword" placeholder="Nueva contraseña"></input>
					<input id="np2" type="password" class="creacion_box" name="newRePassword" placeholder="Repite nueva contraseña"></input>
					<br><br>
					<button disabled="" name="SubmitP" id="SubmitP" class="creacion_boton" type="submit">Cambiar contraseña</button>
				</form>
			</div>
			<!--  -->
			<?php if(getCurrentUser()->type != "miembro"):?>
			<!-- cabecera -->
			<div id="ajustesCab">
				<center><h3>Cambiar color de la cabecera</h3></center>
				<hr style="background-color: #C3C3C3;"><br>
				<input style="text-shadow: 0px 0px 4px rgba(255, 255, 255, 0.5); background-color:#<?php echo getCurrentUser()->cabecera;?>;font-size: 100px; font-weight: bold; text-align: center;" id="cabeceraColor" class="creacion_box" value="#<?php echo getCurrentUser()->cabecera;?>"></input>
			</div>
			<!--  -->
			<div id="ajustesFir">
				<center><h3>Actualizar firma</h3></center>
				<hr style="background-color: #C3C3C3;"><br>
				<div style="float:left; margin-right: 4px;">
					<table id="mm">
						<tr>
							<td><strong>bbcode</strong> </td>
							<td></td>
						</tr>
						<tr>
							<td>[b]negrita[/b] </td>
							<td><strong>negrita</strong></td>
						</tr>
						<tr>
							<td>[i]italic[/i] </td>
							<td><em>italic</em></td>
						</tr>
						<tr>
							<td>[s 8]size[/s] </td>
							<td><span style='font-size: 8;'>size</span></td>
						</tr>
						<tr>
							<td>[c #F4F]color[/c] </td>
							<td><span style='color: #F4F'>color</span></td>
						</tr>
						<tr>
							<td>[ct]center[/ct] </td>
							<td><center>center</center></td>
						</tr>
						<tr>
							<td>[u goo.gl]url[/u] 
							<td><a style="color: #CF3232;" target="_blank" href="http://goo.gl">url</a></td>
						</tr>
						<tr>
							<td>[p]Pikachu[/p] </td>
							<td><img src='/assets/pokemons/Pikachu.png' alt='$innertext' title='$innertext' style='margin-bottom: -8px; margin-top: -12px;'></img></td>
						</tr>
						<tr>
							<td>[im]goo.gl/LpVqvz[/im] </td>
							<td><img src='http://goo.gl/LpVqvz' style='max-width: 50px; height: auto; padding: 4px;'></img></td>
						</tr>
					</table>
				</div>
				<div style="float:left;">
					<textarea name="textCreateTema" id="send_textarea" ><?php echo getCurrentUser()->firma?></textarea>
					<br>
					<div id="firma"><?php echo bb_parse_firma(getCurrentUser()->firma);?></div>
				</div>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>

<script>

$('#np').prop('disabled', true);
$('#np2').prop('disabled', true);
$('#SubmitP').prop('disabled', true);

function verify(data){
	var cont = $("#p").val();
	var cont1 = $("#np").val();
	var cont2 = $("#np2").val();
	
	if(data == 1 && cont.length > 7 && cont.length < 33 && "<?php echo $_COOKIE['bewom_mail'];?>" != cont){
		$("#p").attr("style", "border-color: #00AA00;");
		$('#np').prop('disabled', false);
	} else {
		$('#p').attr("style", "border-color: #AA0000;");
		$('#np').prop('disabled', true);
	}

	if(data == 1 && cont1.length > 7 && cont1.length < 33 && "<?php echo $_COOKIE['bewom_mail'];?>" != cont1 && cont != cont1){
		$("#np").attr("style", "border-color: #00AA00;");
		$('#np2').prop('disabled', false);
	} else {
		$("#np").attr("style", "border-color: #AA0000;");
		$('#np2').prop('disabled', true);
	}

	if(data == 1 && cont2.length > 7 && cont2.length < 33 && "<?php echo $_COOKIE['bewom_mail'];?>" != cont2 && cont1 == cont2 && cont != cont2){
		$("#np2").attr("style", "border-color: #00AA00;");
		$('#SubmitP').prop('disabled', false);
	} else {
		$("#np2").attr("style", "border-color: #AA0000;");
		$('#SubmitP').prop('disabled', true);
	}
}

$('#p').keyup(function (e) {
	var pass = $(this).val();
	$.get("test/verifyPassword/" + pass, function(data) {
		verify(data);
	});
});

$('#np').keyup(function (e) {
	var pass = $('#p').val();
	$.get("test/verifyPassword/" + pass, function(data) {
		verify(data);
	});
});

$('#np2').keyup(function (e) {
	var pass = $('#p').val();
	$.get("test/verifyPassword/" + pass, function(data) {
		verify(data);
	});
});

$('#send_textarea').keyup(function (e) {
	var firma = $(this).val();
	firma = firma.replace(/"/g, "''");
	$.post("test/firma_2/", { p:firma }, function(data) {
		$("#firma").html(data);
	});
});

$('#cabeceraColor').keyup(function (e) {
	var firma = $(this).val();
	firma = firma.replace("#", "");
	$.get("test/cabecera/" + firma, function(data) {
		$("#cabeceraColor").css("background-color", "#" + data);
	});
});

$('#buttonPas').attr( "style", "background-color: #DFDFDF;" );
$('#ajustesFir').hide();
$('#ajustesFir2').hide();
$('#ajustesCab').hide();

$("#buttonPas").click(function() { 
	$('#ajustesPas').show();
	$('#buttonPas').attr( "style", "background-color: #DFDFDF;" );
	$('#ajustesFir').hide();
	$('#ajustesFir2').hide();
	$('#ajustesCab').hide();
	$('#buttonFir').attr( "style", "" );
	$('#buttonCab').attr( "style", "" );
});

$("#buttonFir").click(function() { 
	$('#ajustesFir').show();
	$('#ajustesFir2').show();
	$('#buttonFir').attr( "style", "background-color: #DFDFDF;" );
	$('#ajustesPas').hide();
	$('#ajustesCab').hide();
	$('#buttonPas').attr( "style", "" );
	$('#buttonCab').attr( "style", "" );
});

$("#buttonCab").click(function() { 
	$('#ajustesFir').hide();
	$('#ajustesFir2').hide();
	$('#buttonCab').attr( "style", "background-color: #DFDFDF;" );
	$('#ajustesPas').hide();
	$('#ajustesCab').show();
	$('#buttonPas').attr( "style", "" );
	$('#buttonFir').attr( "style", "" );
});
</script>

</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>