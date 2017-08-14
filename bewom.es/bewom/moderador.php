<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

// error_reporting(E_ALL);
// ini_set("display_errors", true);

if(!isValidSession()):
echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
?>
<style>
	.creacion_box {
	    border: 1px solid #989898;
	    padding: 8px;
	    width: 100%;
	    margin-bottom: 4px;
	}
	.creacion_boton{
		border: 1px solid rgb(152, 152, 152);
		height: 34px;
		width: 508px;
		margin-bottom: 4px;
	    background-color: #f0f0f0;
	}
	.creacion_textarea{
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		font-size: 13px;
		width: 100%;
		height: 128px;
		resize: none;
		padding: 8px;
		border: 1px solid #989898;
		margin-bottom: 4px;
	}
</style>
<body>
<div id="barebone">
	<div id="page">
		<form style="margin: 0px;" action="post">
			
			<h4>Un poco sobre ti.</h4><br/>
			<a style="font-size: 12px;">
				Una persona disponible y con ganas, es una buena candidata para poder ayudar al servidor. Aunque parezca que no, la localidad y la edad son fundamentales para poder ayudar. 
				Si tienes una edad muy temprana puede que no estes preparado para ayudar al servidor, la media de edad de la administración ronda los 20 años, eso implica que para una buena relación se tendría que tener una visión parecida. 
				No falsear datos es esencial, recuerda que estamos en internet y que todo se puede saber. Recuerda que falsear este formulario puede acarear penas de ban permanente.
			</a>
			
			<br/><br/>
			
			<input name="mod_nombre" class="creacion_box" placeholder="¿Cual es tu nombre real?" size="34" autocomplete="off" type="text"></input>
			<input name="mod_anos" class="creacion_box" placeholder="¿Cuantos años tienes?" size="34" autocomplete="off" type="text"></input>
			<input name="mod_pais" class="creacion_box" placeholder="¿De que pais eres?" size="34" autocomplete="off" type="text"></input>
			<input name="mod_pais_hora" class="creacion_box" placeholder="¿Que GMT tienes? (Es decir, la hora local que tienes. En españa tenemos GMT +01 en verano y GMT +02 en invierno.)" size="34" autocomplete="off" type="text"></input>
			<input name="mod_pokemon" class="creacion_box" placeholder="¿Has jugando alguna vez a pokemon y desde cuando?" size="34" autocomplete="off" type="text"></input>
			<input name="mod_tiempo_minecraft" class="creacion_box" placeholder="¿Cuanto tiempo llevas jugando minecraft?" size="34" autocomplete="off" type="text"></input>
			<input name="mod_tiempo_pixelmon" class="creacion_box" placeholder="¿Cuanto tiempo llevas jugando pixelmon?" size="34" autocomplete="off" type="text"></input>
			<input name="mod_tiempo_bewom" class="creacion_box" placeholder="¿Cuanto tiempo llevas jugando en bewom?" size="34" autocomplete="off" type="text"></input>
			<textarea name="mod_mas" class="creacion_textarea" placeholder="Cuentanos un poco sobre ti..."></textarea>
			
			<br/><br/>
			
			<h4>Sobre la moderación.</h4><br/>
			<a style="font-size: 12px;">
				Ser moderador no es tarea fácil y menos para un servidor que tiene necesidad continua de ayudar a la gente como este. La experiencia, años de juego y las ganas de poder ayudar son las únicas aliadas en esta tarea.
				La responsabilidad como moderador consiste en cuidar de los jugadores y ofrecerles ayuda siempre y cuando se pueda. Obviamente, un moderador no puede jugar como un usuario normal, porque no sería justo, así que la tarea principal es ayudar a llevar adelante el servidor unica y exclusivamente.
			</a>
			
			<br/><br/>
			
			<input name="mod_mod_alguna_vez" class="creacion_box" placeholder="¿Has moderado o administrado algun servidor de minecraft? (medianamente grande)" size="34" autocomplete="off" type="text"></input>
			<input name="mod_mod_bewom" class="creacion_box" placeholder="¿Te crees capaz de poder moderar bewom y porque? (breve)" size="34" autocomplete="off" type="text"></input>
			<input name="mod_mod_ayuda" class="creacion_box" placeholder="¿Para que quieres ayudar a bewom a moderar?" size="34" autocomplete="off" type="text"></input>
			<input name="mod_mod_tiempo" class="creacion_box" placeholder="¿En caso de ser moderador, cuanto tiempo podrias dedicar? (dias de la semana y horarios)" size="34" autocomplete="off" type="text"></input>
			<input name="mod_mod_cualidades" class="creacion_box" placeholder="¿Cuales crees que son tus cualidades para poder moderar?" size="34" autocomplete="off" type="text"></input>
			<input name="mod_mod_auto" class="creacion_box" placeholder="¿Crees que tienes autocrítica?" size="34" autocomplete="off" type="text"></input>
			<input name="mod_mod_errores" class="creacion_box" placeholder="¿Te ves capaz de asumir errores a gran escala y sus consecuencias?" size="34" autocomplete="off" type="text"></input>
			<textarea name="mod_mod_mas" class="creacion_textarea" placeholder="Cuentanos un poco sobre tus ideas como moderador..."></textarea>
			
			<br/><br/>
			
			<h4>Ponte a prueba.</h4><br/>
			<a style="font-size: 12px;">
				La práctica hace al maestro. Si no has tenido experiencia en este campo, no implica que no puedas empezar en bewom, no buscamos la perfección, buscamos las ganas.
				Las siguientes preguntas deben responderse con la acción o acciones que realizarias ante estas situaciones.
			</a>
			
			<br/><br/>
			
			<input name="mod_test_1" class="creacion_box" placeholder="Uno o diversos usuarios se meten con un usuario por tener un pokemon que no es muy bueno." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_2" class="creacion_box" placeholder="Uno o diversos usuarios intentan buscar la manera de conseguir cosas de forma mas rápida pero no parece muy legal." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_3" class="creacion_box" placeholder="Uno o diversos usuarios tratan de sembrar el caos con sus pokemons a modo de batallas." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_4" class="creacion_box" placeholder="Uno o diversos usuarios hablan de política o fútbol." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_5" class="creacion_box" placeholder="Uno o diversos usuarios cuentan chistes racistas." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_6" class="creacion_box" placeholder="Uno o diversos usuarios tienen skins sexuales o de personajes históricos." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_7" class="creacion_box" placeholder="Uno o diversos usuarios intentan captar usuarios para otro servidor." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_8" class="creacion_box" placeholder="Uno o diversos usuarios intentan pasarse información sobre redes sociales o aplicaciones de mensajeria." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_9" class="creacion_box" placeholder="Uno o diversos usuarios se burlan de algun usuario por algo externo del servidor." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_10" class="creacion_box" placeholder="Uno o diversos usuarios publican información de otro usuario." size="34" autocomplete="off" type="text"></input>
			<input name="mod_test_1" class="creacion_box" placeholder="¿Si un usuario sale de x a 100 pasos/s, cuanto tarda en encontrarse con el otro usuario si va a 98 pasos/s a 1000 cubos de distancia?" size="34" autocomplete="off" type="text"></input>
			
		</form>
	</div>
</div>

</body>
<?php include 'include/general/footer.php';?>
<?php endif;?>