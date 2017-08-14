<?php
function getGuia(){
	
	$guia = new stdClass();
	$guia->firstCount = 10;
	
	for ($i = 0; $i < $guia->firstCount; $i++) {
		$guia->first[$i] = new stdClass();
	}
	
	$guia->first[0]->pregunta = "
			Dinero, bancos y la cartera.
			";
	$guia->first[0]->respuesta = 
			"La mondea del servidor son los woms, te permiten comprar y vender un montón de objetos en las tiendas y comprar vivienda. 
			También lo puedes usar para comerciar entre los usuarios.
			Esta moneda, esta divida en tres partes:
			- El banco.
			- Los billetes.
			- Las tiendas.
			
			<h3>El Banco</h3>
			Encontraremos dos tipos de banco diferentes en el servidor (aunque funcionan igual), uno es <i>BANKIA</i> y el otro <i>SantaCreeper</i>. Cada uno de estos bancos, tiene sus propios cajeros que funcionan de la misma forma.
			
			<h4>Cajeros</h4>
			Las dos variantes de <i>cajero</i> que nos podemos encontrar son estos:
			
			<img src='assets/guia/atm_bankia.png' /><img src='assets/guia/atm_santacreeper.png' />
			
			<h4>Cartera</h4>
			Esta es la cartera donde se almacenarán nuestros billetes. Puedes abrirla con con click derecho.
			
			<img src='assets/guia/cartera.png' />
			
			Estos cajeros nos permitirán tener nuestro <i>dinero físico</i>, pero nos cobrarán una <i>comisión del 3%</i> cada vez que saquemos woms. 
			La mejor manera de ahorrar, es tener tu dinero en el banco o sacar cantidades grandes, para que la perdida no sea demasiado alta.
			
			El funcionamiento de estos cajeros es muy simple: 
			- Primero de todo, necesitaremos una cartera, el banco es muy generoso y nos regalará carteras infinitas. Haz click en el botón de cartera. 
			- Segundo, para sacar el dinero, colocaremos nuestra cartera vacia en el hueco de la izquierda. Seleccionaremos la cantidad con los botones de mas y menos, tambien podemos seleccionar con el botón '1', la cantidad que sumar o restar. Como es obvio, no puedes sacar mas dinero del que tienes en la cuenta, así que tenlo en cuenta!
			- Tercero, para ingresar dinero, simplemente colocaremos nuestra cartera con los billetes en el hueco derecho. Ahora seleccionaremos la cantidad a ingresar como en el anterior paso,aunque si queremos ingresar todo, haremos click en la opción 'igualar'.
			
			<h3>Los billetes</h3>
			Los billetes son infalsificables. Cada billete almacena un identificador único. Encontraremos distintos tipos de billetes según la cantidad: 
			<img src='assets/guia/bill_1.png' /><img src='assets/guia/bill_2.png' /><img src='assets/guia/bill_5.png' /><img src='assets/guia/bill_10.png' /><img src='assets/guia/bill_20.png' /><img src='assets/guia/bill_50.png' /><img src='assets/guia/bill_100.png' /><img src='assets/guia/bill_200.png' /><img src='assets/guia/bill_500.png' />
			
			Cada uno de ellos nos permitirá hacer combinaciones perfectas para comprar y vender, pero no te preocupes, las tiendas funcionan con la cartera y no tendrás que poner la cantidad exacta, la tienda ya se ocupara de eso por ti.";
	
	$guia->first[1]->pregunta = "
			Comprar y vender.
			";
	$guia->first[1]->respuesta = 
			"Hay distintos metodos de comprar y vender en el servidor, pero el mas seguro es con las tiendas que te ofrecemos.
			
			<h3>Las tiendas</h3>
			El funcionamiento de las tiendas es muy simple:
			- Si quieres comprar un objeto, coloca la cartera en el hueco de la derecha y haz click en el botón de abajo. Recuerda que el precio de compra esta marcado en el mismo botón.
			- Si quieres vender un objeto, coloca la cartera en el hueco de la derecha, en el otro hueco has de colocar el item para vender, para finalizar, haz click en el botón superior.
			
			<img src='assets/guia/tienda.png' />
			
			Tenemos que diferenciar dos tipos de tiendas.
			- Comunistas.
			- Capitalistas.
			
			<h4>Tiendas Comunistas</h4>
			Nos permitirán vender y comprar objetos por precios fijos. Aunque compres o vendas mucho ese objeto, el precio no cambiará.
			<img src='assets/guia/tienda_com.png' />
			
			<h4>Tiendas Capitalistas</h4>
			Nos permitirán vender y comprar objetos por precios variables, cuanto mas compres de este objeto, el precio subirá, cuanto mas vendas, el precio bajará. Esto nos permite tener la ley de la oferta y la demanda, por lo tanto, puedes lucrarte gracias  este sistema.
			<img src='assets/guia/tienda_cap.png' />
			
			<h3>Otros usuarios</h3>
			Como es lógico, puedes vender y comprar cosas a otros usuarios, como pokemons o items del juego. 
			Os recomendamos cerrar tratos en el chat de minecraft, de esta manera, si alguien os intenta estafar, lo podremos pillar. Ten cuidado con los tratos 'demasiado fantasiosos', pueden ser falsos.
			
			<h3>Maquinas de intercambio pokemon</h3>
			Estas maquinas, que podéis encontrar en todos los centros pokemon, sirven para intercambiar pokemons entre dos usuarios.
			Simplemente has de seleccionar el pokemon que quieres intercambiar en la barra de abajo y esperar a que la otra persona ponga el pokemon que quiera cambiar, si los dos estáis de acuerdo con el traro, le daréis al botón del centro y se cerrará el trato.
			<img src='assets/guia/trade_poke.png' />
			";
			
	$guia->first[2]->pregunta = "
			Conseguir recursos de minecraft y pixelmon.
			";
	$guia->first[2]->respuesta = 
			"La única manera de conseguir los recursos naturales que nos ofrece minecraft, será viajando por la puerta de recursos que encontraremos justo detrás del spawn.
			<img src='assets/guia/recursos_portal.png' />
			
			Este mundo esta única y exclusivamente para la recolección de recursos <b>(los ranch se pueden colocar y proteger)</b>.
			
			Este mundo no esta destinado a la creación de casas u otras construcciones, almacenamiento de objetos o captura de pokemons, caulquiera que almacene algo en este mundo puede ser 'robado' (Como este mundo no tiene protección, no se considera robo, no guardes cosas importantes aquí).";
	
	$guia->first[3]->pregunta = "
			Donde construir mi casa.
			";
	$guia->first[3]->respuesta = 
			"Las casas son edificios construidos e irrompibles que encontrarás por el mundo principal.
			Se diferencian de los edificios publicos u otras construcciones porque tienen un cartel de 'venta' delante de ellas.
			
			Para poder comprar una casa, primero tendrás que encontrar una casa con un cartel que ponga '<b>en venta</b>', si el cartel esta tachado por otro que ponga '<b>vendido</b>', no podrás comprarla porque será de otro usuario. Si la casa te interesa, te puedes poner en contacto con el dueño y llegar a un acuerdo, simplemente dale click al cartel y te dará la información necesaria.
			<img src='assets/guia/casa_en_venta.png' /> <img src='assets/guia/casa_vendida.png' />
			
			Para comprar la casa, simplemente le daremos click al cartel de '<b>en venta</b>' y te enviará el precio de la casa por el chat. Si dispones del dinero suficiente y no disponias de ninguna casa previamente, volviendo a hacer click al cartel podrás comprar la casa.";
	
	$guia->first[4]->pregunta = "
			Como luchar contra un pokemon salvaje.
			";
	$guia->first[4]->respuesta = 
			"Lo primero que tendrás que tener es tu pokemon curado. 
			Una vez tengas algun pokemon vivo, tendrás que pulsar la tecla '<b>R</b>' de tu teclado para lanzar a tu pokemon.
			
			<img src='assets/guia/pokemon_rand.png' />
			
			Normalmente, los pokemons que te vayas encontrando por el mundo, querrán luchar contigo, pero si quieres forzar alguna batalla simplemente pulsa '<b>R</b>' apuntando al pokemon deseado o al entrenador. También puedes retar a otro jugador lanzando tu pokemon al pokemon de otro jugador.
			Una vez hayas encontrado a tu pokemon para empezar la batalla, aparecerá una nueva interfaz que te dará información sobre <b>la batalla actual</b>.
			
			<img src='assets/guia/batalla.png' />
			
			- Arriba a la izquierda : Información sobre el pokemon del otro jugador (o salvaje), como el tipo de pokemon, el nivel, la vida...
			- Abajo a la derecha: Nos dará la información de nuestro pokemon actual. Si el nivel de vida llega a 0 y no tenemos ningun otro pokemon en nuestra mano, la batalla habrá concluido.
			- Abajo, en el inventario: Nos aparecerá un menú donde podrás elegir que hacer en este turno.
			&emsp;> Fight: Nos permitirá elegir el ataque que queremos realizar en este momento.
			&emsp;> Pokémon: Nos dejará cambiar el pokemon actual por otro que tengamos en la mano.
			&emsp;> Bag: Nos dejará usar objetos como pokeballs, objetos de batalla, pociones...
			&emsp;> Run: Nos permitirá huir de la batalla (solo te dejará huir de la batalla con pokemons salvajes).";
	
	$guia->first[5]->pregunta = "
			Como organizar tus pokemons.
			";
	$guia->first[5]->respuesta = 
			"En el servidor, repartidos por todos los centros pokemons, podrás encontrar estos '<b>pcs</b>' que te permitirán guardar todos tus pokemons menos uno.
			Siempre tendrás que tener un pokemon en la mano.
			
			<img src='assets/guia/pc.png' />
			
			Para poder guardar y volver a ponerte un pokemon en la mano, tendrás que dar click sobre la maquina y se te abrirá una interfaz con todos los pokemons que tengas almacenados.
			
			<img src='assets/guia/pc_inside.png' />
			
			- En la parte superior: Te driá la caja en la que te encuentras (tienes 16 cajas).
			- En la esquina inferior: Encontrarás tus pokemons actuales en la mano que podrás guardar o borrar.
			- En la esquina inferior derecha: Te encontraras una papelera, si quieres eliminar un pokemon de forma <b>PERMANENTE</b> selecciona el pokemon y muevelo hasta allí. Recuerda que se borran de forma <b>PERMANENTE</b> y no podrás recuperarlo nunca mas.
			
			Cada caja tiene un tamaño de 5x6 que te permite almacenar 30 pokemons por caja. En total podrás almacenar <b>480 pokemons</b>.";
	
	$guia->first[6]->pregunta = "
			Pokeballs y sus crafteos
			";
	$guia->first[6]->respuesta = 
			"Las <b>pokeballs</b> son objetos usados para <b>capturar pokemons</b>, no se pueden usar para capturar entrenadores, pokemons boss, ni los pokemons de los entrenadores
			
			Las pokeballs solo se pueden usar dentro de batalla, tendrás que estar luchando contra un pokemon salvaje para poder capturarlo. No podrás capturar los pokemons de otros entrenadores o jugadores.
			Para capturar dentro del combate, tendrás que abrir la mochila, seleccionar el botón de la pokeball y seleccionar la pokeball que mas se ajuste a tus necesidades.
			
			Tamnbién, cuando uses una pokeball, tiene una probabilidad de que se rompa, así que perderá toda su efectividad y encima no podrás recuperarla, solo algunas piezas. Las únicas que no se rompen son la master ball, la parque ball, la cherish ball y la gs ball.
			
			
			<h4>Crafteos y objetos previos a las pokeballs</h4>
			Primero necesitarás un yunque mecánico o un yunque normal. Con el yunque mecánico no necesitaras los martillos.
			Si quieres usar un yunque normal, tendrás que craftear un martillo.
			
			<b>Martillos</b>
			
			- Madera
			<img src='http://i.imgur.com/Bzjixnl.png'>
			
			- Piedra
			<img src='http://i.imgur.com/VP6ZkpN.png'>
			
			- Hierro
			<img src='http://i.imgur.com/zFzlXlV.png'>
			
			- Oro
			<img src='http://i.imgur.com/eoJtoGY.png'>
			
			- Diamante
			<img src='http://i.imgur.com/JQXy5UZ.png'>
			
			
			<b>Yunques</b>
			
			- Yunque normal
			<img src='http://i.prntscr.com/85193ef536174e9bbd965f17ef8dc82c.png'>
			
			- Yunque mecánico
			<img src='http://i.imgur.com/ijkPg5K.png'>
			
			
			<h4>Tipos de pokeballs y crafteos</h4>
			
			El crafteo de la parte inferior de una pokeball es siempre el mismo.
			
			- Hierro
			<img src='http://i.imgur.com/LJAor1Y.png'>
			
			- Aluminio
			<img src='http://i.imgur.com/VEU5c0S.png'>
			
			
			Las diferencias entre pokeballs son los efectos que causan y los niveles de eficiencia a la hora de capturar un pokemon.
			
			- Pokeball - La más basica de todas.
			- LureBall - (en construcción).
			- Superball - 50% mejor captura que la pokeball.
			- UltraBall - 100% mejor captura que la pokeball.
			<img src='asdkjsadkj'>
			- Buceoball - Mejor captura pokemons de agua.
			- Ocasoball - Mejor captura si el lugar es oscuro o es de noche.
			- Rapidball - Mejor captura si el pokemon tiene 100 de velocidad de base o mas.
			- Amigoball - El pokemon capturado tiene una felicidad base de 200.
			- Gsball - Igual que la pokeball pero no se puede romper.
			- Sanaball - Igual que la pokeball pero el pokemon capturado se cura.
			- Pesoball - Mejor captura cuanto mas pesado sea el pokemon.
			- Nivelball - Mejor captura en función de los niveles de tu pokemon. 
			- Armorball - Mucha mejor captura si tu pokemon es de la misma especie y de genero opuesto que el que se quiere capturar.
			- Ceboball - Mejor captura con pokemons pescados.
			- Lujoball - Igual que la pokeball pero mejora la felicidad.
			- Lunaball - Mejor captura si una de las evoluciones del pokemon es con piedra lunar.
			- Nidoball - Mejor captura cuanto mas por debajo del nivel del mar se use.
			- Mallaball - Mejor captura si el pokemon es de tipo bicho o agua.
			- Premierball - Igual que la pokeball pero emite particulas rojas cuando se lanza.
			- Velozball - Mejor captura si se usa en el primer turno.
			- Acopioball - Mejor captura si tienes un pokemon identico.
			- Safariball - Mejor captura en biomas plains.
			- Competiball - Mejor captura con pokemons de tipo bicho.
			- Turnoball - Mejor captura cuantos mas turnos pasen.
			
			- Parqueball - Capturará al pokemon siempre.
			- Masterball - Capturará al pokemon siempre.
			
			";
	
	$guia->first[7]->pregunta = "
			¿MT's, MO's y pociones?
			";
	$guia->first[7]->respuesta = "";
	
	return $guia;
	
}
?>