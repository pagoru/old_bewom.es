<div id="background-absolute" class="absolute-background" style="display: none;"> </div>
<div id="box-absolute" class="absolute-box" style="display: none;">
	<div class="absolute-inside-box">
		<div class="absolute-bb">
			<div class="absolute-option">
				<div class="absolute-option-title">negrita</div>
				<div>[b]hola[/b]</div>
				<div style="font-weight: bold;">hola</div>
			</div>
			<div class="absolute-option">
				<div class="absolute-option-title">cursiva</div>
				<div>[i]hola[/i]</div>
				<div style="font-style: italic;">hola</div>
			</div>
			<div class="absolute-option">
				<div class="absolute-option-title">tamaño</div>
				<div>[s 10]hola[/s]</div>
				<div style="font-size: 10px;">hola</div>
			</div>
			<div class="absolute-option">
				<div class="absolute-option-title">color</div>
				<div>[c F4F]hola[/c]</div>
				<div style="color: #F4F;">hola</div>
			</div>
			<div class="absolute-option">
				<div class="absolute-option-title">centrar</div>
				<div>[ct]hola[/ct]</div>
				<div style="text-align: center;">hola</div>
			</div>
			<div class="absolute-option">
				<div class="absolute-option-title">link</div>
				<div>[u http://gob.es]hola[/u]</div>
				<div style="text-align: center;">hola</div>
			</div>
			<div class="absolute-option">
				<div class="absolute-option-title">pokes</div>
				<div>[p]Pikachu[/p]</div>
				<div style="text-align: center;"><img src="/assets/pokemons/025.png" alt="Pikachu" title="Pikachu" style="margin-top: -12px;" /></div>
			</div>
			<div class="absolute-option">
				<div class="absolute-option-title">link</div>
				<div>[im]bewom.es/gato.jpg[/im]</div>
				<div style="text-align: center;"><img src="http://bewom.es/gato.jpg" style="max-width: 34px; height: auto; padding: 4px;"></div>
			</div>
		</div>
		<div class="absolute-form">
		
			<?php
			$t = substr(getCurrentUser()->type, 0, 1);
			
			$urlPost = "/post/r/".$tema->indice."/".$tema->foro."/".$t."/";
			?>
		
			<form id="form_create" action="<?php echo $urlPost;?>" method="post">
				<select name="icon" style="width: 100px;" class="input-absolute-title">
					<?php foreach ($pokemonList as $poke):?>
					<option value="<?php echo $poke;?>" <?php if($poke == $tema->icon){ echo "selected";}?>><?php echo $poke;?></option>
					<?php endforeach;?>
				</select>
				
				<select name="open" style="width: 100px;" class="input-absolute-title">
					<option value="1" <?php if($tema->open){echo "selected";}?>>abierto</option>
					<option value="0" <?php if(!$tema->open){echo "selected";}?>>cerrado</option>
				</select>
				<select name="fijado" style="width: 100px;" class="input-absolute-title">
					<option value="0" <?php if(!$tema->fijado){echo "selected";}?>>no fijado</option>
					<option value="1" <?php if($tema->fijado){echo "selected";}?>>fijado</option>
				</select>
				
				<input name="title" style="width: 326px;" class="input-absolute-title" value="<?php echo $tema->nombre;?>"></input>
				<textarea name="text" id="textarea" class="textarea-absolute"></textarea>
				<div id="preview" class="preview-absolute"></div>
				<button id="crear" class="submit-absolute">Responder</button>
				<div id="restante" class="restante-absolute"></div>
			</form>
		</div>
	</div>
</div>
<script>
<?php include 'scriptCreate.js';?>
</script>