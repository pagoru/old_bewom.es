<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

// error_reporting(E_ALL);
// ini_set("display_errors", true);

$inputParams 	= $_GET["p"];
$param 			= explode("/", $inputParams);

$foroName 		= $param[0];
$postNumber 	= $param[1];


if(!isValidSession()):
echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
?>
<style>
	<?php include "./css/_foro.css";?>
</style>
<body>
<?php
	if(empty($postNumber)){
		if(isForo($foroName)){
			$foro = getForo_($foroName);
			if(getCurrentUser()->type == "admin"){
				include 'include/_foro/createTemaAdmin.php';
			} else {
				if($foro->open){
					include 'include/_foro/createTema.php';
				}
			}
		}
	} else {
		if(isTema($postNumber, $foroName)){
			$tema = getTema_($postNumber);
			if(getCurrentUser()->type == "admin"){
				include 'include/_foro/createRespuestaAdmin.php';
			} else {
				if($tema->open){
					include 'include/_foro/createRespuesta.php';
				}
			}
		}
	}
?>
<div id="barebone">
	<div id="page">	
		
		<?php if(empty($foroName) && empty($postNumber)):?> <!-- Foros + nuevos temas + nuevas respuestas -->
		
			<table>
				
				<tr class="temas-categoria-tr-foro">
					<td class="categorias-foro-td categorias-foro-td-info">
						<div style="color: #454545;" class="temas-categoria-selector">
							Categorias
						</div>
					</td>
					<td /><td />
				</tr>
				
				<?php foreach (getForos_() as $foro):?>
					
					<?php 
						$icon = "background-image: url(/assets/pokemons/".getIntFromPokemon($foro->icon).".png);";
						if(!$foro->open){
							$icon = "background-image: url(/assets/foro/cerrado.png), 
										url(/assets/pokemons/".getIntFromPokemon($foro->icon).".png);";
						}
					?>
					
					<tr class="categorias-foro-tr">
						<td class="categorias-foro-td categorias-foro-td-info">
							<a class="categorias-foro-link" href="<?php echo $foro->nombre;?>/">
								<div class="categorias-foro-icono" style="<?php echo $icon?>"></div>
								<div class="categorias-foro-info">
									<div>
										<div class="categorias-foro-titulo">
											<?php echo $foro->nombre;?>
										</div>
									</div>
									<div>
										<div class="categorias-foro-descripcion">
											<?php echo $foro->descripcion;?>
										</div>
									</div>
								</div>
							</a>
						</td>
						<td class="categorias-foro-td categorias-foro-td-last">
							<div class="categorias-foro-ultimosTemas">
							
								<?php foreach (getLastTemas_($foro->nombre) as $foroLastTemas):?>
								 
									<div>
										<a href="<?php echo $foro->nombre;?>/<?php echo $foroLastTemas->indice?>/">
											<?php echo $foroLastTemas->nombre;?>
										</a>
										<a class="categorias-foro-ultimoTemaFecha">
											<?php echo getDateFromCurrent($foroLastTemas->fecha);?>
										</a>
									</div>
									
								<?php endforeach;?>
								
							</div>
						</td>
						<td class="categorias-foro-td categorias-foro-td-stats">
							<div class="categorias-foro-numTemas">
								<a class="categorias-foro-numTemas-count">
									<?php echo $foro->numTemas;?>
								</a>
								<a> temas</a>
							</div>
						</td>
					</tr>
					
				<?php endforeach;?>
			
			</table>
			
		<?php elseif(empty($postNumber)):?> <!-- Foro + los temas del foro y nuevas respuestas del mismo -->
		
			<?php if(isForo($foroName)):?>
			
				<?php $foro = getForo_($foroName);?>
				
				<table style="border-bottom: 0px solid;">
					<tr class="temas-categoria-tr-foro">
						<td class="temas-categoria-td temas-categoria-td-title">
							<div style="color: #454545;" class="temas-categoria-selector">
								<a href="../">Categorias</a> » <?php echo $foroName;?>
							</div>
						</td>
						<td /><td /><td />
					</tr>
					
				</table>
				
				<table style="margin-bottom: 8px;">
					<?php if($foro->open || getCurrentUser()->type == "admin"):?>
					<tr class="temas-categoria-tr openCrear">
						<td class="temas-categoria-td temas-categoria-td-title" style="padding: 0px;">
							<div id="openCrear" class="temas-categoria-selector" style="padding: 8px; width:100%">
								Crear tema
							</div>
						</td>
					</tr>
					<?php endif;?>
				</table>
				
				<table>
					
					<tr class="temas-categoria-tr">
						<td class="temas-categoria-td temas-categoria-td-title">
							<div style="margin-left: 4px;" class="temas-categoria-selector">
								Tema
							</div>
						</td>
						<td class="temas-categoria-td temas-categoria-td-reply">
							<div class="temas-categoria-selector">
								Réplicas
							</div>
						</td>
						<td class="temas-categoria-td temas-categoria-td-views">
							<div class="temas-categoria-selector">
								Visitas
							</div>
						</td>
						<td class="temas-categoria-td temas-categoria-td-user">
							<div class="temas-categoria-selector">
								Actividad
							</div>
						</td>
					</tr>
					<?php foreach (getTemas_($foroName) as $tema):?>
					
						<?php 
							$icon = "background-image: url(/assets/pokemons/".getIntFromPokemon($tema->icon).".png);";
							if(!$tema->open){
								$icon = "background-image: url(/assets/foro/cerrado.png), 
											url(/assets/pokemons/".getIntFromPokemon($tema->icon).".png);";
							}
							$fixed = "";
							if($tema->fijado){
								$fixed = "background: #FFF url('/assets/foro/fijado.png') repeat scroll 0% 0% / 4px auto;";
							}
						?>
					
						<tr class="temas-categoria-tr" style="<?php echo $fixed;?>">
							<td class="temas-categoria-td temas-categoria-td-title">
								<a href="<?php echo $tema->indice;?>/">
									<div class="temas-categoria-icono" style="<?php echo $icon?>"></div>
									<div class="temas-categoria-title-exterior">
										<div class="temas-categoria-title"><?php echo $tema->nombre;?></div>
									</div>
								</a>
							</td>
							<td class="temas-categoria-td temas-categoria-td-reply">
								<div class="temas-categoria-reply">
									<?php echo $tema->replicas?>
								</div>
							</td>
							<td class="temas-categoria-td temas-categoria-td-views">
								<div class="temas-categoria-views">
									<?php echo $tema->visitas?>
								</div>
							</td>
							<td class="temas-categoria-td temas-categoria-td-user">
								<div class="temas-categoria-user">
									<?php echo getDateFromCurrent($tema->lastReplica);?>
								</div>
							</td>
						</tr>
						
					<?php endforeach;?>
					
				</table>
				<table>
					<?php if($foro->open || getCurrentUser()->type == "admin"):?>
					<tr style="border-top: 8px solid #DFDFDF;" class="temas-categoria-tr openCrear">
						<td class="temas-categoria-td temas-categoria-td-title" style="padding: 0px;">
							<div id="openCrear1" class="temas-categoria-selector" style="padding: 8px; width:100%">
								Crear tema
							</div>
						</td>
					</tr>
					<?php endif;?>
				</table>
				
			<?php else:?>
			
				<?php echo error404();?>
				
			<?php endif;?>
			
		<?php else:?> <!-- Tema + respuestas de este -->
			
			<?php if(isTema($postNumber, $foroName)):?>
				
				<?php $tema = getTema_($postNumber);?>
				
				<?php sumaVisitasTema($postNumber);?>
				
				<table style="border-bottom: 0px solid;">
					<tr class="tema-tr-foro">
						<td class="tema-td tema-td-title">
							<div style="color: #454545;" class="temas-categoria-selector">
								<a href="/foro/">Categorias</a> » <a href="../"><?php echo $foroName;?></a> » <?php echo $tema->nombre;?>
							</div>
						</td>
					</tr>
									
				</table>
				
				<table style="margin-bottom: 8px;">
					<?php if($tema->open || getCurrentUser()->type == "admin"):?>
					<tr class="temas-categoria-tr openCrear">
						<td class="temas-categoria-td temas-categoria-td-title" style="padding: 0px;">
							<div id="openCrear" class="temas-categoria-selector" style="padding: 8px; width:100%">
								Responder
							</div>
						</td>
					</tr>
					<?php endif;?>
				</table>
				
				<table>
					<tr class="tema-tr-other">
						<td class="tema-td-user">
							<div class="tema-td-user-in">
								<a href="/perfil/<?php echo $tema->user->name; ?>">
									<div class="tema-td-user-photo <?php echo $tema->user->type;?>" style="background: transparent url('https://minotar.net/helm/<?php echo $tema->user->name;?>/32') no-repeat scroll 0% 0%;"></div>
								</a>
								
								<!-- MEDALLAS -->
								<div style="display: table-cell; top: 70px; padding: 19px; padding-top: 0px;">
								<?php for ($i = 0; $i < count($tema->user->medallas); $i++):?>
									<div id="M_0<?php echo $tema->user->medallas[$i]; ?>" style="cursor: pointer; height: 16px; width: 16px;background: url('/assets/medallas/<?php echo $tema->user->medallas[$i]; ?>.png') no-repeat scroll 0% 0% / 100% 100%;float: left;">
										<div id="hoverM_0<?php echo $tema->user->medallas[$i]; ?>" class="nameHover" style="margin-top: 16px;margin-left: 16px;display: none;"><?php echo $tema->user->medallasDef[$i]; ?></div>
									</div>
								<?php endfor;?>
								</div>
								<script>
								<?php for ($i = 0; $i < count($tema->user->medallas); $i++):?>
								$("#M_0<?php echo $tema->user->medallas[$i];?>").hover( 
									function() {
										$("#hoverM_0<?php echo $tema->user->medallas[$i];?>").show();
									}, function() {
										$("#hoverM_0<?php echo $tema->user->medallas[$i];?>").hide();
								});
								<?php endfor;?>
								</script>
								<!-- MEDALLAS FIN -->
								
							</div>				
						</td>
						<td class="tema-td-text">
							<div class="tema-td-text-user">
								<a class="<?php echo $tema->user->type; ?>" href="/perfil/<?php echo $tema->user->name; ?>">
									<?php echo $tema->user->name;?>
								</a>
								
								<!-- MODO ADMIN -->
								<?php if(getCurrentUser()->type == "admin"):?>
									
									<e class="edit_buttons">
										<a id="tema_editar">editar</a>
										<?php 
											$t = substr(getCurrentUser()->type, 0, 1);
											$urlPost = "/post/t_d/".$tema->indice."/".$foroName."/".$t."/";
										?>
										<a href="<?php echo $urlPost;?>">eliminar</a>
									</e>
									
									<script>
										$("#tema_editar").click(function (e) {
											$("#form_create").attr("action", "/post/t_m/<?php echo $postNumber;?>/<?php echo $foroName;?>/a/");
											$("#textarea").val(`<?php echo deleteBr($tema->texto);?>`);
											$("#preview").html(`<?php echo bb_parse($tema->texto, $tema->user->type);;?>`);
											$("#crear").html("Editar");
											showCreateBox();
											return;
										});
									</script>
									
								<?php endif;?>
								
								<a style="display: table-cell;float: right; margin-right: 8px;"><?php echo getDateTime($tema->fecha);?></a>
							</div>
							<div class="tema-td-text-text">
								<?php echo bb_parse($tema->texto, $tema->user->type);?>
								
								<?php if(!empty($tema->user->firma)):?>
									<hr class="tema-td-text-hr"/>
									<?php echo bb_parse_firma($tema->user->firma, $tema->user->type);?>
								<?php endif;?>
								
							</div>
						</td>
					</tr>
					
					<?php foreach ($tema->respuestas as $respuesta):?>
					
					<tr class="tema-tr-other">
						<td class="tema-td-user">
							<div class="tema-td-user-in">
								<a href="/perfil/<?php echo $respuesta->user->name; ?>">
									<div class="tema-td-user-photo <?php echo $respuesta->user->type;?>" style="background: transparent url('https://minotar.net/helm/<?php echo $respuesta->user->name;?>/32') no-repeat scroll 0% 0%;"></div>
								</a>
								
								<!-- MEDALLAS -->
								<div style="display: table-cell; top: 70px; padding: 19px; padding-top: 0px;">
								<?php for ($i = 0; $i < count($respuesta->user->medallas); $i++):?>
									<div id="M_<?php echo $respuesta->orden.$respuesta->user->medallas[$i]; ?>" style="cursor: pointer; height: 16px; width: 16px;background: url('/assets/medallas/<?php echo $respuesta->user->medallas[$i]; ?>.png') no-repeat scroll 0% 0% / 100% 100%;float: left;">
										<div id="hoverM_<?php echo $respuesta->orden.$respuesta->user->medallas[$i]; ?>" class="nameHover" style="margin-top: 16px;margin-left: 16px;display: none;"><?php echo $respuesta->user->medallasDef[$i]; ?></div>
									</div>
								<?php endfor;?>
								</div>
								<script>
								<?php for ($i = 0; $i < count($respuesta->user->medallas); $i++):?>
								$("#M_<?php echo $respuesta->orden.$respuesta->user->medallas[$i];?>").hover( 
									function() {
										$("#hoverM_<?php echo $respuesta->orden.$respuesta->user->medallas[$i];?>").show();
									}, function() {
										$("#hoverM_<?php echo $respuesta->orden.$respuesta->user->medallas[$i];?>").hide();
								});
								<?php endfor;?>
								</script>
								<!-- MEDALLAS FIN -->
								
							</div>				
						</td>
						<td class="tema-td-text">
							<div class="tema-td-text-inner">
								<div class="tema-td-text-user">
									<a class="<?php echo $respuesta->user->type; ?>" href="/perfil/<?php echo $respuesta->user->name; ?>">
										<?php echo $respuesta->user->name;?>
									</a>
									
									<!-- MODO ADMIN -->
									<?php if(getCurrentUser()->type == "admin"):?>
										
										<e class="edit_buttons">
											<a id="respuesta_<?php echo $respuesta->indice;?>">editar</a>
											<?php 
												$t = substr(getCurrentUser()->type, 0, 1);
												$urlPost = "/post/r_d/".$respuesta->indice."-".$postNumber."/".$foroName."/".$t."/";
											?>
											<a href="<?php echo $urlPost;?>">eliminar</a>
										</e>
										
										<script>
											$("#respuesta_<?php echo $respuesta->indice;?>").click(function (e) {
												$("#form_create").attr("action", "/post/r_m/<?php echo $respuesta->indice?>-<?php echo $postNumber;?>/<?php echo $foroName;?>/a/");
												$("#textarea").val(`<?php echo deleteBr($respuesta->texto);?>`);
												$("#preview").html(`<?php echo bb_parse($respuesta->texto, $tema->user->type);;?>`);
												$("#crear").html("Editar");
												showCreateBox();
												return;
											});
										</script>
										
									<?php endif;?>
									
									<a style="float: right; margin-right: 8px;"><?php echo getDateTime($respuesta->fecha);?></a>
								</div>
								<div class="tema-td-text-text">
									<?php echo bb_parse($respuesta->texto, $respuesta->user->type);?>
									
									<?php if(!empty($respuesta->user->firma)):?>
										<hr class="tema-td-text-hr"/>
										<?php echo bb_parse_firma($respuesta->user->firma, $respuesta->user->type);?>
									<?php endif;?>
									
								</div>
							</div>
						</td>
					</tr>
					
					<?php endforeach;?>
					
				</table>
				<table>
					<?php if($tema->open || getCurrentUser()->type == "admin"):?>
					<tr style="border-top: 8px solid #DFDFDF;" class="temas-categoria-tr openCrear">
						<td class="temas-categoria-td temas-categoria-td-title" style="padding: 0px;">
							<div id="openCrear1" class="temas-categoria-selector" style="padding: 8px; width:100%">
								Responder
							</div>
						</td>
					</tr>
					<?php endif;?>
				</table>
			
			<?php else:?>
			
				<?php echo error404();?>
				
			<?php endif;?>
			
		<?php endif;?>
		
	</div>
</div>
<script>

hideCreateBox();

<?php
if(empty($postNumber)):
	?>
	$("#openCrear").click(function (e) {
		showCreateBox();
		return;
	});
	$("#openCrear1").click(function (e) {
		showCreateBox();
		return;
	});
	<?php
else:
	if(isTema($postNumber, $foroName)):
		$tema = getTema_($postNumber);
		
		$t = substr(getCurrentUser()->type, 0, 1);
		$urlPost = "/post/r/".$tema->indice."/".$tema->foro."/".$t."/";
		
		?>
		$("#openCrear").click(function (e) {
			$("#form_create").attr("action", "<?php echo $urlPost;?>");
			$("#crear").html("Responder");
			showCreateBox();
			return;
		});
		$("#openCrear1").click(function (e) {
			$("#form_create").attr("action", "<?php echo $urlPost;?>");
			$("#crear").html("Responder");
			showCreateBox();
			return;
		});
		<?php
	endif;
endif;
?>
</script>
</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>