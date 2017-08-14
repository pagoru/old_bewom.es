<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<style>
<?php include "../../css/style_pokeball.css";?>
</style>

<div id="pokeImage_all" class="pokeImage_all""></div>
<div id="pokeImage_logo" style="background-size: 320px auto;"></div>

<div id="poke_up">
	<div id="pokeImage_up"></div>
</div>
<div id="poke_down">
	<div id="pokeImage_down"></div>
</div>

<script>
$('html, body').css({
    'overflow': 'hidden',
    'height': '100%'
});

$( "#pokeImage_all" ).click(function() {

	$(this).delay(512).queue(function(next) { 
		
		$(this).attr("style", "transform: rotate(-15deg); -ms-transform: rotate(-15deg); -webkit-transform: rotate(-15deg); transition: .4s;"); next(); 
		
		$(this).delay(512).queue(function(next) { 
			
			$(this).attr("style", "transform: rotate(15deg); -ms-transform: rotate(15deg); -webkit-transform: rotate(15deg); transition: .4s;"); next(); 

			$(this).delay(512).queue(function(next) { 
				
				$(this).attr("style", "transform: rotate(-15deg); -ms-transform: rotate(-15deg); -webkit-transform: rotate(-15deg); transition: .4s;"); next(); 
				
				$(this).delay(512).queue(function(next) { 
					
					$(this).attr("style", "transform: rotate(15deg); -ms-transform: rotate(15deg); -webkit-transform: rotate(15deg); transition: .4s;"); next(); 

					$(this).delay(512).queue(function(next) { 
						
						$(this).attr("style", "transform: rotate(0deg); -ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); transition: .4s;"); next(); 

						$(this).delay(512).queue(function(next) {
						
							$( "#pokeImage_up" ).attr("class", "pokeImage_up");
							$( "#pokeImage_down" ).attr("class", "pokeImage_down");
							$(this).replaceWith("");
							
							$( "#pokeImage_logo" ).animate({
							    opacity: 0.00,
							    backgroundSize: "+=256",
							  }, 512, function() {
								$(this).replaceWith("");
							});
							
							$( "#poke_up" ).delay( 2048 ).animate({
							    opacity: 1.00,
							    marginTop: "-=5000"
							  }, 4096, function() {
								  $(this).replaceWith("");
							    // Animation complete.
							});
							
							$( "#poke_down" ).delay( 2048 ).animate({
							    opacity: 1.00,
							    marginTop: "+=10000",
							  }, 4096, function() {
								$(this).replaceWith("");
								$('html, body').css({
								    'overflow': 'auto',
								    'height': 'auto'
								});
							});

						});
						
					});
					
				});
			});
			
		});
	});
});
</script>