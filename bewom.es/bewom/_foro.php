<?php 
include 'include/general/functions.php';
include 'include/general/cabecera.php';

$param = $_GET["param1"];

$p = explode("/", $param);

$p1 = $p[0];

$p2 = $p[1];

$foro = getForos();

if(!isValidSession()):
echo "<META HTTP-EQUIV='refresh' CONTENT='0;".WEB."entrar'>";
else:
	
$count = getCountTorneos();
?>
<style>
<?php include "css/style_foro.css";?>

.botonInscribirse{
	display: table-cell;
	background-color: #CF3232;
	padding: 4px;
	color: #FFF;
	font-weight: bold;
	border: 0px solid;
	border-bottom: 2px solid #A00;
	font-size: 18px;
}
.botonInscribirse:active{
	border-top: 2px solid #A00;
	border-bottom: 0px solid #A00;
}

.formInscribirse{
	width: 100%;
	height: 100%;
	float: left;
	margin-bottom: 0px;
}

.nameHover {
	position: absolute;
	background-color: #333;
	margin-top: 28px;
	margin-left: 28px;
	padding: 4px;
	border-radius: 0px 6px 6px 6px;
	font-weight: bold;
	color: #FFF;
	box-shadow: 4px 4px 0px 0px rgba(105, 105, 105, 0.5);
}
</style>
<body>

<div id="barebone">
	<div id="page">
			<?php if(empty($p1) && empty($p2)):?>
			<div class="aa" style="height: 26px;">
			<h4 class="foro_direcciones">
				<a>Foro</a>
			</h4>
			</div>
			<table>
				<thead>
					<tr>
						<th width="44%"><a>Foro</a></th>
						<th width="8%">Temas</th>
						<th width="8%">RÃ©plicas</th>
						<th width="40%"><span>Ãšltimo mensaje</span></th>
					</tr>
				</thead>
			<tbody>
			<?php elseif(!empty($p1) && empty($p2)):?>
			<table>
				<thead>
					<tr>
						<th width="44%"><a>Tema</a></th>
						<th width="8%">RÃ©plicas</th>
						<th width="8%">Visitas</th>
						<th width="40%"><span>Ãšltimo mensaje</span></th>
					</tr>
				</thead>
			<tbody>
			<?php elseif(!empty($p1) && !empty($p2)):?>
			<table>
			<tbody>
			<?php endif;?>
			<?php 
			$oo = 1;
			$uu = 1;
			$ee = 1;
			foreach ($foro as $foroI):
				if(empty($p1) && empty($p2)):
					$icon = "background-image: url(/assets/pokemons/".getIntFromPokemon($foroI->icon).".png);";
					if(!$foroI->open){
						$icon = "background-image: url(/assets/foro/cerrado.png), url(/assets/pokemons/".getIntFromPokemon($foroI->icon).".png);";
					}
				?>
				<!-- MIN -->
					<?php if(getCurrentUser()->type == "admin" && getCurrentUser()->adminMode):?>
					<form method="post">
						<tr id="trStyle">
							<td>
								<select name="editIcon<?php echo str_replace(" ", "", $foroI->nombre);?>" id="admin_foros_icon">
									<?php
									foreach ($pokemonList as $poke):
									?>
									<option <?php if($foroI->icon == $poke){ echo "selected";}?> value="<?php echo $poke;?>"><?php echo $poke;?></option>
									<?php
									endforeach;
									?>
								</select>
								<input name="editName<?php echo str_replace(" ", "", $foroI->nombre);?>" value="<?php echo $foroI->nombre;?>"></input>
							</td>
							<td></td>
							<td></td>
							<td>
								<select name="editOpen<?php echo str_replace(" ", "", $foroI->nombre);?>" id="admin_foros_open">
									<option <?php if($foroI->open){ echo "selected";}?> value="1">abierto</option>
									<option <?php if(!$foroI->open){ echo "selected";}?> value="0">cerrado</option>
								</select>
								<button name="edit<?php echo str_replace(" ", "", $foroI->nombre);?>" style="float: right;">editar</button>
								<button name="delete<?php echo str_replace(" ", "", $foroI->nombre);?>" style="float: right;">eliminar</button>
							</td>
						</tr>
					</form>
					<?php
					$str = str_replace(" ", "", $foroI->nombre);
					$s = "edit".$str;
					if(isset($_POST[$s])){
						
						editForo($_POST["editName".$str], $foroI->nombre, $_POST["editOpen".$str], $_POST["editIcon".$str]);
						
					}
					?>
					<?php
					$s = "delete".$str;
					if(isset($_POST[$s])){
						
						deleteForo($foroI->nombre);
						
					}
					?>
					<?php endif;?>
				<!-- END MIN -->
				<tr>
					<td>
						<i class="iconForum" style="<?php echo $icon;?> background-repeat: no-repeat;"></i>
						<a class="titleForum" href="/foro/<?php echo $foroI->nombre;?>"><?php echo $foroI->nombre;?></a><br>
					</td>
					<td class="topics"><center><span class="numeroPosts"><?php echo getCountTemas($foroI->temas)?></span></center></td>
					<td class="posts"><center><span class="numeroPosts"><?php echo getCountPosts($foroI->temas)?></span></center></td>
					<td class="lastpost"><span>
						<a href="/perfil/<?php echo getLastTema($foroI)->user->name;?>" >
							<div class="lastPostImage <?php echo getLastTema($foroI)->user->type; ?>" style="background: url('https://minotar.net/helm/<?php echo getLastTema($foroI)->user->name; ?>/26') no-repeat scroll "></div>
						</a>
						<dfn><a href="/foro/<?php echo $foroI->nombre."/".getLastTema($foroI)->indice;?>">Ãšltimo tema</a></dfn> por <a class="<?php echo getLastTema($foroI)->user->type;?>" style="font-weight: bold;" href="/perfil/<?php echo getLastTema($foroI)->user->name; ?>"><?php echo getLastTema($foroI)->user->name; ?></a>
						<br><?php echo getDateTime(getLastTema($foroI)->fecha); ?></span>
					</td>
				</tr>
				<?php
				elseif(!empty($p1) && empty($p2)):
					if($foroI->nombre == $p1):
						?>
						<?php $oo++;?>
						<div class="aa" style="height: 26px;">
						<h4 class="foro_direcciones">
							<a href="/foro">Foro</a> Â»
							<a><?php echo $foroI->nombre;?></a>
						</h4>
						</div>
						
						<?php
						foreach ($foroI->temas as $temas):
						$icon = "background-image: url(/assets/pokemons/".getIntFromPokemon($temas->icon).".png);";
						if(!$temas->open){
							$icon = "background-image: url(/assets/foro/cerrado.png), url(/assets/pokemons/".getIntFromPokemon($temas->icon).".png);";
						}
						?>
						<?php if ($temas->fijado):?>
						<!-- FIJADO -->
						<!-- MIN -->
							<?php if(getCurrentUser()->type == "admin" && getCurrentUser()->adminMode):?>
							<form method="post">
								<tr id="trStyle">
									<td>
										<select name="editForo<?php echo str_replace(" ", "", $temas->indice);?>" id="admin_foros_foros" style="width: 90px;">
											<?php
											foreach ($foro as $foroF):
											?>
											<option <?php if($temas->foro == $foroF->nombre){ echo "selected";}?> value="<?php echo $foroF->nombre;?>"><?php echo $foroF->nombre;?></option>
											<?php
											endforeach;
											?>
										</select>
										<select name="editIcon<?php echo str_replace(" ", "", $temas->indice);?>" id="admin_foros_icon" style="width: 90px;">
											<?php
											foreach ($pokemonList as $poke):
											?>
											<option <?php if($temas->icon == $poke){ echo "selected";}?> value="<?php echo $poke;?>"><?php echo $poke;?></option>
											<?php
											endforeach;
											?>
										</select>
										<input name="editName<?php echo str_replace(" ", "", $temas->indice);?>" value="<?php echo $temas->nombre;?>" style="width: 90px;"></input>
									</td>
									<td></td>
									<td></td>
									<td>
										<select name="editOpen<?php echo str_replace(" ", "", $temas->indice);?>" id="admin_foros_open">
											<option <?php if($temas->open){ echo "selected";}?> value="1">abierto</option>
											<option <?php if(!$temas->open){ echo "selected";}?> value="0">cerrado</option>
										</select>
										<select name="editFixed<?php echo str_replace(" ", "", $temas->indice);?>" id="admin_foros_open">
											<option <?php if($temas->fijado){ echo "selected";}?> value="1">fijado</option>
											<option <?php if(!$temas->fijado){ echo "selected";}?> value="0">no fijado</option>
										</select>
										<button name="edit<?php echo str_replace(" ", "", $temas->indice);?>" style="float: right;" type="submit">editar</button>
										<button name="delete<?php echo str_replace(" ", "", $temas->indice);?>" style="float: right;" type="submit">eliminar</button>
									</td>
								</tr>
							</form>
							<?php
							$str = str_replace(" ", "", $temas->indice);
							$s = "edit".$str;
							if(isset($_POST[$s])){
								  
								editTema($temas->indice, $_POST["editForo".$str], $_POST["editIcon".$str], $_POST["editName".$str], $_POST["editOpen".$str], $_POST["editFixed".$str]);
								
							}
							?>
							<?php
							$s = "delete".$str;
							if(isset($_POST[$s])){
								
								deleteTema($temas->indice);
								
							}
							?>
							<?php endif;?>
						<!-- END MIN -->
						<tr id="trFixed">
							<td>
								<i class="iconForum" style="<?php echo $icon;?> background-repeat: no-repeat;"></i>
								<a class="titleForum" href="/foro/<?php echo $foroI->nombre."/".$temas->indice;?>"><?php echo $temas->nombre;?></a><br>
							</td>
							<td class="topics"><center><span class="numeroPosts"><?php echo getCountRespuestas($temas)?></span></center></td>
							<td class="posts"><center><span class="numeroPosts"><?php echo $temas->visitas?></span></center></td>
							<td class="lastpost"><span>
								<a href="/perfil/<?php echo getLastRespuestaTema($temas)->user->name; ?>" >
									<div class="lastPostImage <?php echo getLastRespuestaTema($temas)->user->type; ?>" style="background: url('https://minotar.net/helm/<?php echo getLastRespuestaTema($temas)->user->name; ?>/26') no-repeat scroll "></div>
								</a>
								<dfn><a href="/foro/<?php echo $foroI->nombre."/".$temas->indice."#".getLastRespuestaTema($temas)->orden;?>">Ãšltimo mensaje</a></dfn> por <a class="<?php echo getLastRespuestaTema($temas)->user->type;?>" style="font-weight: bold;" href="/perfil/<?php echo getLastRespuestaTema($temas)->user->name; ?>"><?php echo getLastRespuestaTema($temas)->user->name; ?></a>
								<br><?php echo getDateTime(getLastRespuestaTema($temas)->fecha); ?></span>
							</td>
						</tr>
					<!-- END FIJADO -->
					<?php 
					endif;
					endforeach;
					?>
						<?php
						foreach ($foroI->temas as $temas):
						$icon = "background-image: url(/assets/pokemons/".getIntFromPokemon($temas->icon).".png);";
						if(!$temas->open){
							$icon = "background-image: url(/assets/foro/cerrado.png), url(/assets/pokemons/".getIntFromPokemon($temas->icon).".png);";
						}
						?>
						<?php if (!$temas->fijado):?>
						<!-- NO FIJADO -->
						<!-- MIN -->
							<?php if(getCurrentUser()->type == "admin" && getCurrentUser()->adminMode):?>
							<form method="post">
								<tr id="trStyle">
									<td>
										<select name="editForo<?php echo str_replace(" ", "", $temas->indice);?>" id="admin_foros_foros" style="width: 90px;">
											<?php
											foreach ($foro as $foroF):
											?>
											<option <?php if($temas->foro == $foroF->nombre){ echo "selected";}?> value="<?php echo $foroF->nombre;?>"><?php echo $foroF->nombre;?></option>
											<?php
											endforeach;
											?>
										</select>
										<select name="editIcon<?php echo str_replace(" ", "", $temas->indice);?>" id="admin_foros_icon" style="width: 90px;">
											<?php
											foreach ($pokemonList as $poke):
											?>
											<option <?php if($temas->icon == $poke){ echo "selected";}?> value="<?php echo $poke;?>"><?php echo $poke;?></option>
											<?php
											endforeach;
											?>
										</select>
										<input name="editName<?php echo str_replace(" ", "", $temas->indice);?>" value="<?php echo $temas->nombre;?>" style="width: 90px;"></input>
									</td>
									<td></td>
									<td></td>
									<td>
										<select name="editOpen<?php echo str_replace(" ", "", $temas->indice);?>" id="admin_foros_open">
											<option <?php if($temas->open){ echo "selected";}?> value="1">abierto</option>
											<option <?php if(!$temas->open){ echo "selected";}?> value="0">cerrado</option>
										</select>
										<select name="editFixed<?php echo str_replace(" ", "", $temas->indice);?>" id="admin_foros_open">
											<option <?php if($temas->fijado){ echo "selected";}?> value="1">fijado</option>
											<option <?php if(!$temas->fijado){ echo "selected";}?> value="0">no fijado</option>
										</select>
										<button name="edit<?php echo str_replace(" ", "", $temas->indice);?>" style="float: right;" type="submit">editar</button>
										<button name="delete<?php echo str_replace(" ", "", $temas->indice);?>" style="float: right;" type="submit">eliminar</button>
									</td>
								</tr>
							</form>
							<?php
							$str = str_replace(" ", "", $temas->indice);
							$s = "edit".$str;
							if(isset($_POST[$s])){
								  
								editTema($temas->indice, $_POST["editForo".$str], $_POST["editIcon".$str], $_POST["editName".$str], $_POST["editOpen".$str], $_POST["editFixed".$str]);
								
							}
							?>
							<?php
							$s = "delete".$str;
							if(isset($_POST[$s])){
								
								deleteTema($temas->indice);
								
							}
							?>
							<?php endif;?>
						<!-- END MIN -->
						<tr>
							<td>
								<i class="iconForum" style="<?php echo $icon;?> background-repeat: no-repeat;"></i>
								<a class="titleForum" href="/foro/<?php echo $foroI->nombre."/".$temas->indice;?>"><?php echo $temas->nombre;?></a><br>
							</td>
							<td class="topics"><center><span class="numeroPosts"><?php echo getCountRespuestas($temas)?></span></center></td>
							<td class="posts"><center><span class="numeroPosts"><?php echo $temas->visitas?></span></center></td>
							<td class="lastpost"><span>
								<a href="/perfil/<?php echo getLastRespuestaTema($temas)->user->name; ?>" >
									<div class="lastPostImage <?php echo getLastRespuestaTema($temas)->user->type; ?>" style="background: url('https://minotar.net/helm/<?php echo getLastRespuestaTema($temas)->user->name; ?>/26') no-repeat scroll "></div>
								</a>
								<dfn><a href="/foro/<?php echo $foroI->nombre."/".$temas->indice."#".getLastRespuestaTema($temas)->orden;?>">Ãšltimo mensaje</a></dfn> por <a class="<?php echo getLastRespuestaTema($temas)->user->type;?>" style="font-weight: bold;" href="/perfil/<?php echo getLastRespuestaTema($temas)->user->name; ?>"><?php echo getLastRespuestaTema($temas)->user->name; ?></a>
								<br><?php echo getDateTime(getLastRespuestaTema($temas)->fecha); ?></span>
							</td>
						</tr>
					<!-- END NO FIJADO -->
					<?php 
					endif;
					endforeach;
					?>
					<!-- MIN -->
						<?php if($foroI->open || getCurrentUser()->type == "admin"):?>
						<form method="post">
								<tbody>
									<table>
										<tr id="trCrearStyle">
											<td style="border-top: 0px solid;">
												<div class="aa" style="width: 256px;">
													<div></div>
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
														<?php if(getCurrentUser()->type == "vip" || getCurrentUser()->type == "admin" || getCurrentUser()->type == "mod"):?>
														<tr>
															<td>[p]Pikachu[/p] </td>
															<td><img src='/assets/pokemons/<?php echo getIntFromPokemon("Pikachu");?>.png' alt='$innertext' title='$innertext' style='margin-bottom: -8px; margin-top: -12px;'></img></td>
														</tr>
														<tr>
															<td>[im]goo.gl/LpVqvz[/im] </td>
															<td><img src='http://goo.gl/LpVqvz' style='max-width: 50px; height: auto; padding: 4px;'></img></td>
														</tr>
														<?php endif;?>
													</table>
												</div>
												<div class="ae" style="margin-bottom: -8px; width: 592px;">
													<select style="margin-left: 8px; height: 30px;" name="iconCreateTema" id="admin_foros_icon">
														<?php
														foreach ($pokemonList as $poke):
														?>
														<option value="<?php echo $poke;?>"><?php echo $poke;?></option>
														<?php
														endforeach;
														?>
													</select>
													<input style="height: 30px;" name="nameCreateTema" value="Nombre tema"></input>
													<?php if(getCurrentUser()->type == "admin"):?>
													<select style="height: 30px;" name="openCreateTema" id="admin_temas_open">
														<option value="1">abierto</option>
														<option value="0">cerrado</option>
													</select>
													<select style="height: 30px;" name="fixedCreateTema" id="admin_temas_fijado">
														<option value="0">no fijado</option>
														<option value="1">fijado</option>
													</select>
													<?php endif;?>
													<div class="ac" style="border-bottom: 0px; width: 472px;">
														<textarea name="textCreateTema" id="send_textarea"></textarea>
													</div>
													<button name="submitCreateTema" id="Submit" class="creacion_boton" type="submit">Crear tema</button>
													<div id="aa" style="float: right; padding: 8px;">5120 carÃ¡cteres restantes.</div>
												</div>
											</td>
										</tr>
										<script>
										$("#Submit").prop('disabled', true);
										
										$("#send_textarea").keyup(function (e) {
											$a = 5120 - $(this).val().length;
											if($a < 0 || $a == 5120){
												$("#Submit").prop('disabled', true);
											} else {
												$("#Submit").prop('disabled', false);
											}
											$("#aa").html($a + " carÃ¡cteres restantes.");
											return;
										});
										$("#Submit").hover(function (e) {
											$a = 5120 - $("#send_textarea").val().length;
											if($a < 0 || $a == 5120){
												$("#Submit").prop('disabled', true);
											} else {
												$("#Submit").prop('disabled', false);
											}
											$("#aa").html($a + " carÃ¡cteres restantes.");
											return;
										});
										</script>
									</tbody>
								</table>
							</form>
							<?php 
								
							if(isset($_POST['submitCreateTema'])){
									
								$fixed = $_POST['fixedCreateTema'];
								$open = $_POST['openCreateTema'];
								
								if(getCurrentUser()->type != "admin"){
									
									$fixed = false;
									$open = true;
									
								}

								createNewTema($_POST['iconCreateTema'], $_POST['nameCreateTema'], getCurrentUser()->uuid, $fixed, $open, $_POST['textCreateTema'], $foroI->nombre);								
								
							}
							
							?>
						<?php endif;?>
					<!-- END MIN -->
					<?php endif;?>
					<?php
				elseif(!empty($p1) && !empty($p2)):
					if($foroI->nombre == $p1):
					?>
					<?php $oo++;?>
						<?php
						foreach ($foroI->temas as $temas):
							$icon = "background-image: url(/assets/pokemons/".getIntFromPokemon($temas->icon).".png);";
							if(!$temas->open){
								$icon = "background-image: url(/assets/foro/cerrado.png), url(/assets/pokemons/".getIntFromPokemon($temas->icon).".png);";
							}
							if($temas->indice == $p2):
								?>
								<?php $uu++;?>
								<div class="aa" style="height: 26px;">
								<h4 class="foro_direcciones">
									<a href="/foro">Foro</a> Â»
									<a href="/foro/<?php echo $foroI->nombre;?>"><?php echo $foroI->nombre;?></a> Â»
									<a><?php echo " ".$temas->nombre;?></a>
								</h4>
								</div>
								<tr>
									<td>
										<div class="aa" style="height: 26px;">
											<i class="iconForum" style="<?php echo $icon;?> background-repeat: no-repeat; margin-top: -6px; float: right;"></i>
										</div>
										<div class="ae">
											<h2 style="float:left">
												 <?php echo " ".$temas->nombre;?> 
											</h2>
										</div>
									</td>
								</tr>
								<!-- MIN -->
									<?php if(getCurrentUser()->type == "admin" && getCurrentUser()->adminMode):?>
									<form method="post">
									<tr id="trStyle">
										<td id="trCrearStyle">
											<div class="aa">	
												<button name="edit<?php echo str_replace(" ", "", $temas->nombre);?>">editar</button>
												<button name="delete<?php echo str_replace(" ", "", $temas->nombre);?>">eliminar</button>
											</div>
											<div class="af">
												<div class="ae">
													<textarea name="editText<?php echo str_replace(" ", "", $temas->nombre);?>" 
														style="resize: none; width: 695px; height: 148px;"><?php echo str_replace("<br />", "", $temas->texto);?></textarea>
												</div>
											</div>
										</td>
									</tr>
									</form>
									<?php
									$str = str_replace(" ", "", $temas->nombre);
									$s = "edit".$str;
									if(isset($_POST[$s])){
										
										editTemaText($temas->indice, $_POST["editText".$str]);
										
									}
									?>
									<?php
									$s = "delete".$str;
									if(isset($_POST[$s])){
										
										deleteTema($temas->indice);
										
									}
									?>
									<?php endif;?>
								<!-- END MIN -->
								<table>
									<tr>
										<td id="perfilPrincipal" class="aa" style="background: rgba(256, 256, 256, 1) url('/assets/info_inv.png') repeat scroll 0% 0%;">
											<div class="ab">
												<a class="<?php echo $temas->user->type;?>" style="font-weight: bold;" href="/perfil/<?php echo $temas->user->name;?>"><?php echo $temas->user->name;?></a>
											</div>
											<a href="/perfil/<?php echo $temas->user->name; ?>" >
												<div class="<?php echo $temas->user->type;?>" id="foro_profile_image" style="background: url('<?php echo "https://minotar.net/helm/".$temas->user->name."/54";?>') no-repeat scroll ">
												</div>
											</a>
											<!-- MEDALLAS -->
											<div style="display: table-cell; padding: 12px;">
											<?php for ($i = 0; $i < count($temas->user->medallas); $i++):?>
												<div id="M_0<?php echo $temas->user->medallas[$i]; ?>" style="cursor: pointer; height: 32px; width: 32px;background: url('/assets/medallas/<?php echo $temas->user->medallas[$i]; ?>.png') no-repeat scroll 0% 0% / 100% 100%;;float: left;">
													<div id="hoverM_0<?php echo $temas->user->medallas[$i]; ?>" class="nameHover" style="margin-top: 32px;margin-left: 32px;display: none;"><?php echo $temas->user->medallasDef[$i]; ?></div>
												</div>
											<?php endfor;?>
											</div>
											<script>
											<?php for ($i = 0; $i < count($temas->user->medallas); $i++):?>
											$("#M_0<?php echo $temas->user->medallas[$i];?>").hover( 
												function() {
													$("#hoverM_0<?php echo $temas->user->medallas[$i];?>").show();
												}, function() {
													$("#hoverM_0<?php echo $temas->user->medallas[$i];?>").hide();
											});
											<?php endfor;?>
											</script>
											<!-- MEDALLAS FIN -->
										</td>
										<td class="af" id="temaPrincipal">
											<div class="ac">
												<a style="position: absolute; margin-top: -84px;" name="0"></a>
												<?php echo bb_parse($temas->texto, $temas->user->type);?>
											</div>
											<div class="ad">
												publicado el <?php echo getDateTime($temas->fecha);?>
											</div>
											<div class="ae" style="width: 684px;">
												<?php echo bb_parse_firma($temas->user->firma);?>
											</div>
										</td>
									</tr>
								</table>
								<script>
								jQuery(window).load(function () {
									if($("#temaPrincipal").height() > $("#perfilPrincipal").height()){
										$("#perfilPrincipal").css("height", $("#temaPrincipal").height()); 
									} else {
										$("#temaPrincipal").css("height", $("#perfilPrincipal").height()); 
									}
								});
								</script>
								<?php 
								incrementarVisitasTema($temas);
								foreach ($temas->respuestas as $respuesta):
								?>
								<!-- MIN -->
								<table>
									<?php if(getCurrentUser()->type == "admin" && getCurrentUser()->adminMode):?>
									<form method="post">
									<tr id="trStyle">
										<td id="trCrearStyle">
											<div class="aa">
												<button name="edit<?php echo str_replace(" ", "", $respuesta->indice);?>">editar</button>
												<button name="delete<?php echo str_replace(" ", "", $respuesta->indice);?>">eliminar</button>
											</div>
											<div class="af">
												<div class="ae">
													<textarea name="editText<?php echo str_replace(" ", "", $respuesta->indice);?>" 
													style="resize: none; width: 695px; height: 148px;"><?php echo str_replace("<br />", "", $respuesta->texto);?></textarea>
												</div>
											</div>
										</td>
									</tr>
									</form>
									<?php
									$str = str_replace(" ", "", $respuesta->indice);
									$s = "edit".$str;
									if(isset($_POST[$s])){
										
										editrespuesta($respuesta->indice, $_POST["editText".$str]);
										
									}
									?>
									<?php
									$s = "delete".$str;
									if(isset($_POST[$s])){
										
										deleteRespuesta($respuesta->indice);
										
									}
									?>
									<?php endif;?>
								<!-- END MIN -->
									<tr>
										<td id="perfilPrincipal<?php echo $respuesta->orden;?>" class="aa" style="background: rgba(256, 256, 256, 1) url('/assets/info_inv.png') repeat scroll 0% 0%;">
											<div class="ab">
												<a class="<?php echo $respuesta->user->type;?>" style="font-weight: bold;" href="/perfil/<?php echo $respuesta->user->name;?>"><?php echo $respuesta->user->name;?></a>
											</div>
											<a href="/perfil/<?php echo $respuesta->user->name; ?>" >
												<div class="<?php echo $respuesta->user->type;?>" id="foro_profile_image" style="background: url('<?php echo "https://minotar.net/helm/".$respuesta->user->name."/54";?>') no-repeat scroll ">
												</div>
											</a>
											<!-- MEDALLAS -->
											<div style="display: table-cell; padding: 12px;">
											<?php for ($i = 0; $i < count($respuesta->user->medallas); $i++):?>
												<div id="M_<?php echo $respuesta->orden;?><?php echo $respuesta->user->medallas[$i]; ?>" style="cursor: pointer; height: 32px; width: 32px;background: url('/assets/medallas/<?php echo $respuesta->user->medallas[$i]; ?>.png') no-repeat scroll 0% 0% / 100% 100%;;float: left;">
													<div id="hoverM_<?php echo $respuesta->orden;?><?php echo $respuesta->user->medallas[$i]; ?>" class="nameHover" style="margin-top: 32px;margin-left: 32px;display: none;"><?php echo $respuesta->user->medallasDef[$i]; ?></div>
												</div>
											<?php endfor;?>
											</div>
											<script>
											<?php for ($i = 0; $i < count($respuesta->user->medallas); $i++):?>
											$("#M_<?php echo $respuesta->orden;?><?php echo $respuesta->user->medallas[$i];?>").hover( 
												function() {
													$("#hoverM_<?php echo $respuesta->orden;?><?php echo $respuesta->user->medallas[$i];?>").show();
												}, function() {
													$("#hoverM_<?php echo $respuesta->orden;?><?php echo $respuesta->user->medallas[$i];?>").hide();
											});
											<?php endfor;?>
											</script>
											<!-- MEDALLAS FIN -->
										</td>
										<td id="temaPrincipal<?php echo $respuesta->orden;?>" class="af">
											<a style="position: absolute; margin-top: -80px;" name="<?php echo $respuesta->orden;?>"></a>
											<div class="ac">
												<?php echo bb_parse($respuesta->texto, $respuesta->user->type);?>
											</div>
											<div class="ad">
												publicado el <?php echo getDateTime($respuesta->fecha);?>
											</div>
											<div class="ae" style="width: 684px;">
												<?php echo bb_parse_firma($respuesta->user->firma);?>
											</div>
										</td>
										<script>
										jQuery(window).load(function () {
											if($("#temaPrincipal<?php echo $respuesta->orden;?>").height() > $("#perfilPrincipal<?php echo $respuesta->orden;?>").height()){
												$("#perfilPrincipal<?php echo $respuesta->orden;?>").css("height", $("#temaPrincipal<?php echo $respuesta->orden;?>").height()); 
											} else {
												$("#temaPrincipal<?php echo $respuesta->orden;?>").css("height", $("#perfilPrincipal<?php echo $respuesta->orden;?>").height()); 
											}
										});
										</script>
									</tr>
								</table>
								<?php
								endforeach;
								?> 
								<?php if ($temas->open || getCurrentUser()->type == "admin"):?>
								<table>
									<form method="post">
										<tr id="trCrearStyle">
											<td>
												<div class="aa" style="width: 256px;">
													<div></div>
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
														<?php if(getCurrentUser()->type == "vip" || getCurrentUser()->type == "admin" || getCurrentUser()->type == "mod"):?>
														<tr>
															<td>[p]Pikachu[/p] </td>
															<td><img src='/assets/pokemons/<?php echo getIntFromPokemon("Pikachu");?>.png' alt='$innertext' title='$innertext' style='margin-bottom: -8px; margin-top: -12px;'></img></td>
														</tr>
														<tr>
															<td>[im]goo.gl/LpVqvz[/im] </td>
															<td><img src='http://goo.gl/LpVqvz' style='max-width: 50px; height: auto; padding: 4px;'></img></td>
														</tr>
														<?php endif;?>
													</table>
												</div>
												<div class="ae" style="margin-bottom: -8px; width: 592px;">
													<div class="ac" style="border-bottom: 0px; width: 472px;">
														<textarea name="textCreateRespuesta" id="send_textarea"></textarea>
													</div>
													<button name="submitCreateRespuesta" id="Submit" class="creacion_boton" type="submit">Responder</button>
													<div id="aa" style="float: right; padding: 8px;">5120 carÃ¡cteres restantes.</div>
												</div>
											</td>
											<script>
											$("#Submit").prop('disabled', true);
											
											$("#send_textarea").keyup(function (e) {
												$a = 5120 - $(this).val().length;
												if($a < 0 || $a == 5120){
													$("#Submit").prop('disabled', true);
												} else {
													$("#Submit").prop('disabled', false);
												}
												$("#aa").html($a + " carÃ¡cteres restantes.");
												return;
											});
											$("#Submit").hover(function (e) {
												$a = 5120 - $("#send_textarea").val().length;
												if($a < 0 || $a == 5120){
													$("#Submit").prop('disabled', true);
												} else {
													$("#Submit").prop('disabled', false);
												}
												$("#aa").html($a + " carÃ¡cteres restantes.");
												return;
											});
											</script>
										</tr>
									</form>
								</table>
								<?php 
								
								if(isset($_POST['submitCreateRespuesta'])){
									
									createNewRespuesta(getCurrentUser()->uuid, $_POST['textCreateRespuesta'], $temas->indice);				
									
								}
								
								?>
								<?php endif; ?>
								<?php $uu++;?>
								<?php
							endif;
						endforeach;
					endif;
					?>
					<?php
				endif;	
			endforeach;
			?>
				
			<?php if(empty($p1) && empty($p2)):?>
				<!-- MIN -->
					<?php if(getCurrentUser()->type == "admin"):?>
					<tr id="trCrearStyle">
						<form method="post">
							<td>
								<select name="iconCreateForo" id="admin_foros_icon">
									<?php
									foreach ($pokemonList as $poke):
									?>
									<option value="<?php echo $poke;?>"><?php echo $poke;?></option>
									<?php
									endforeach;
									?>
								</select>
								<input name="nameCreateForo" value="Nombre foro"></input>
							</td>
							<td></td>
							<td></td>
							<td>
								<select name="openCreateForo" id="admin_foros_open">
									<option value="1">abierto</option>
									<option value="0">cerrado</option>
								</select>
								<button name="submitCreateForo" type="submit" style="float: right;">crear</button>
							</td>
						</form>
						<?php 
						if(isset($_POST['submitCreateForo'])){
							
							createNewForo($_POST['iconCreateForo'], $_POST['nameCreateForo'], $_POST['openCreateForo']);
							
						}
						?>
					</tr>
					<?php endif;?>
				<!-- END MIN -->
			</tbody>
		</table>
		<br/>
		<h4 style="margin-left: 8px;">Ãšltimas respuestas</h4>
		<br/>
		<tbody>
			<table>
			<?php foreach (getAllLastRespuestas() as $reps):
			
			$icon = "background-image: url(/assets/pokemons/".getIntFromPokemon($reps->tema->icon).".png);";
			if(!$reps->tema->open){
				$icon = "background-image: url(/assets/foro/cerrado.png), url(/assets/pokemons/".getIntFromPokemon($reps->tema->icon).".png);";
			}
			?>
				<tr>
					<td>
						<div style="display: table-cell; float: left; border-right: 2px solid rgb(128, 128, 128); padding-right: 4px; margin-right: 4px;">
							<i class="iconForum" style="<?php echo $icon;?> background-repeat: no-repeat;"></i>
							<a class="titleForum" href="/foro/<?php echo $reps->tema->foro."/".$reps->tema->indice."#".getLastRespuestaTema($reps->tema)->orden;?>"><?php echo $reps->tema->nombre;?></a>
						</div>
						<div style="height: 20px; overflow: hidden;">
							<?php echo bb_parse($reps->texto, $reps->user->type);?>
						</div>
					</td>
					<td class="lastpost" width="40%"><span>
							<a href="/perfil/<?php echo $reps->user->name;?>" >
								<div class="lastPostImage <?php echo $reps->user->type; ?>" style="background: url('https://minotar.net/helm/<?php echo $reps->user->name; ?>/26') no-repeat scroll "></div>
							</a>
							<dfn><a href="/foro/<?php echo $reps->tema->foro."/".$reps->tema->indice."#".getLastRespuestaTema($reps->tema)->orden;?>">Ãšltima respuesta </a></dfn> por <a class="<?php echo $reps->user->type;?>" style="font-weight: bold;" href="/perfil/<?php echo $reps->user->name; ?>"><?php echo $reps->user->name; ?></a>
						<br><?php echo getDateTime($reps->fecha); ?></span>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<br/>
		<h4 style="margin-left: 8px;">Ãšltimos temas</h4>
		<br/>
		<tbody>
			<table>
			<?php foreach (getAllLastTemas() as $reps):
			
			$icon = "background-image: url(/assets/pokemons/".getIntFromPokemon($reps->icon).".png);";
			if(!$reps->open){
				$icon = "background-image: url(/assets/foro/cerrado.png), url(/assets/pokemons/".getIntFromPokemon($reps->icon).".png);";
			} 
			?>
				<tr>
					<td>
						<div style="display: table-cell; float: left; border-right: 2px solid rgb(128, 128, 128); padding-right: 4px; margin-right: 4px;">
							<i class="iconForum" style="<?php echo $icon;?> background-repeat: no-repeat;"></i>
							<a class="titleForum" href="/foro/<?php echo $reps->foro."/".$reps->indice."#".getLastRespuestaTema($reps)->orden;?>"><?php echo $reps->nombre;?></a>
						</div>
						<div style="height: 20px; overflow: hidden;">
							<?php echo bb_parse($reps->texto, $reps->user->type);?>
						</div>
					</td>
					<td class="lastpost" width="40%"><span>
							<a href="/perfil/<?php echo $reps->user->name;?>" >
								<div class="lastPostImage <?php echo $reps->user->type; ?>" style="background: url('https://minotar.net/helm/<?php echo $reps->user->name; ?>/26') no-repeat scroll "></div>
							</a>
							<dfn><a href="/foro/<?php echo $reps->foro."/".$reps->indice;?>">Ãšltimo tema </a></dfn> por <a class="<?php echo $reps->user->type;?>" style="font-weight: bold;" href="/perfil/<?php echo $reps->user->name; ?>"><?php echo $reps->user->name; ?></a>
						<br><?php echo getDateTime($reps->fecha); ?></span>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
			<?php elseif(!empty($p1) && empty($p2)):?>
			</tbody>
		</table>
			<?php elseif(!empty($p1) && !empty($p2)):?>
			</tbody>
		</table>
			<?php endif;?>
			<?php if(getCurrentUser()->type == "admin"):?>
			<form method="post" style="width: 100%;height: 100%;float: left;margin-bottom: 0px;">
				<button name="adminMode" type="submit" style="width: 100%;background-color: #454545;color: rgb(255, 255, 255);height: 28px;font-size: 14px;font-weight: bold;">
				<?php if(getCurrentUser()->adminMode): echo "Desactivar moderaciÃ³n."; else: echo "Activar moderaciÃ³n."; endif;?>
				</button>
			</form> 
			<?php endif;?>
	</div>
</div>
<?php
if(!empty($p1) && empty($p2)){
	
	if($oo == 1){
	
		echo "<meta http-equiv='refresh' content='0; url=".WEB."404' />";
	
	}
	
} elseif(!empty($p1) && !empty($p2)) {
	
	if($oo == 1 || $uu == 1){
		
		echo "<meta http-equiv='refresh' content='0; url=".WEB."404' />";
		
	}
	
}
?>
</body>
<?php endif;?>
<?php include 'include/general/footer.php';?>