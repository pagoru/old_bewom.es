<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';
?>



	<style>
		<?php include "./css/style_creacion.css";?>
	</style>
	<body>
	
	<div id="barebone">
		<div id="page">
		
			<div id="columnLeft">
				<h2><center>Creación de la cuenta</center></h2>
				<hr>
				<div id="insideDiv">
					<div id="text" >
						<?php echo "<b>".$user."</b>";?>, <br> 
						Rellena los campos con información válida, el correo electrónico será verificado y la contraseña será esencial para entrar a la web.
					</div>
					<div id="normas" style="display: none;">
						Hola <?php echo "<b>".$user."</b>";?>, <br> 
						Bienvenido al asistente de creación de una cuenta para el servidor de pixelmon de bewom.es<br><br>
						Debes respetar las normas del servidor, el incumplimiento de estas pueden conllevar sanciones.
						Estas sanciones pueden ser simples advertencias, expulsiones temporales o expulsiones permanentes.
						<br><br>
						<?php include 'include/normas/normas.php';?>
					</div>
					<br>
					<form method="post">
						<input id="email" name="email" class="creacion_box" placeholder="Email" size="34" autocomplete="off" type="text">
						<input id="reEmail" name="reEmail" class="creacion_box" placeholder="Repite el email" size="34" autocomplete="off" type="text" style="margin-bottom: 8px;">
						<input id="contrasena" name="contrasena" class="creacion_box" placeholder="Contraseña" size="34" autocomplete="off" type="password">
						<input id="reContrasena" name="reContrasena" class="creacion_box" placeholder="Repite la contraseña" size="34" autocomplete="off" type="password">
						<div id="br"><br></div>
						<button id="crear" name="crear" class="creacion_boton" type="submit" style="display: none;">Crear Cuenta</button>
					</form>
					<button style="width: 100%;" id="submit" name="submit" class="creacion_boton" type="submit">Acepto las normas, términos y condicones y política de cookies</button>
				</div>
			</div>
			<div id="columnRight">
				<h2><center>¡Puedes donar!</center></h2>
				<hr class="vipBa">
				<?php include 'include/general/puedesDonar.php';?>
				<hr class="vipBa">
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		
	<script type="text/javascript">
	
	var el=$('#columnRight');
	var elpos=el.offset().top;
	$(window).scroll(function () {
	    var y=$(this).scrollTop();
	    if(y<elpos){el.stop().animate({'margin-top':0},500);}
	    else{el.stop().animate({'margin-top':y-elpos + 80},500);}
	});
	
	$("#crear").prop('disabled', true);
	$("#text").hide();
	$("#email").hide();
	$("#reEmail").hide();
	$("#contrasena").hide();
	$("#reContrasena").hide();
	$("#br").hide();
	$("#normas").show();
	
	function verify(){
		var email = $("#email").val();
		var reEmail = $("#reEmail").val();
		var cont = $("#contrasena").val();
		var reCont = $("#reContrasena").val();
	
		var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		if (testEmail.test(email)){
			$("#email").attr("class", "creacion_box");
			$("#email").addClass("valid_box");
		} else {
			$("#email").attr("class", "creacion_box");
			$("#email").addClass("error_box");
		}
		if (testEmail.test(email) && email == reEmail){
			$("#reEmail").attr("class", "creacion_box");
			$("#reEmail").addClass("valid_box");
		} else {
			$("#reEmail").attr("class", "creacion_box");
			$("#reEmail").addClass("error_box");
		}
	
		if(cont.length > 7 && cont.length < 33 && reEmail != cont){
			$("#contrasena").attr("class", "creacion_box");
			$("#contrasena").addClass("valid_box");
		} else {
			$("#contrasena").attr("class", "creacion_box");
			$("#contrasena").addClass("error_box");
		}
	
		if(cont.length > 7 && cont.length < 33 && reEmail != cont &&  cont == reCont){
			$("#reContrasena").attr("class", "creacion_box");
			$("#reContrasena").addClass("valid_box");
		} else {
			$("#reContrasena").attr("class", "creacion_box");
			$("#reContrasena").addClass("error_box");
		}
	
		if(testEmail.test(email) && email == reEmail && cont.length > 7 && cont.length < 33 && reEmail != cont && cont == reCont){
			$("#crear").prop('disabled', false);
		} else {
			$("#crear").prop('disabled', true);
		}
	}
		
	$(document).ready(function() {
		$("#email").keyup(function (e) {
			verify();
			return;
		});
		$("#reEmail").keyup(function (e) {
			verify();
			return;
		});
		$("#contrasena").keyup(function (e) {
			verify();
			return;
		});
		$("#reContrasena").keyup(function (e) {
			verify();
			return;
		});
		$("#submit").click(function () {
			
			$("#text").show();
			$("#email").show();
			$("#reEmail").show();
			$("#contrasena").show();
			$("#reContrasena").show();
			$("#br").show();
			$("#normas").hide();
	
			$("#crear").show();
			$("#submit").hide();
	
			$("html, body").animate({
				scrollTop:0
			}, '500', 'swing', function() { 
			   
			});
			
			return;
		});
	});
			
	</script>
	
	</body>
