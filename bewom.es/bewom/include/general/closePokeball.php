<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<style>
<?php include "../../css/style_pokeball.css";?>
</style>

<div id="pokeImage_all" class="pokeImage_all""></div>
<div id="pokeImage_logo" style="background-size: 320px auto;"></div>

<div id="poke_up"></div>
<div id="poke_down"></div>

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
						
					});
					
				});
			});
			
		});
	});
});
</script>