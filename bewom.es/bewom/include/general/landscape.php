<div class="landscape"><div id="imageTop" class="landImage"></div><div id="imageBottom" class="landImage"></div></div>
<?php
$d = scandir("assets/portada");
$i = 0;
foreach($d as $img){
	if(strpos($img, ".png")){
		$images = $images."assets/portada/".$img.",";
		$i++;
	}
}
$images = substr($images, 0, strlen($images) - 1);
?>
<script>
jQuery(window).load(function () {
	
	var images = "<?php echo $images;?>";
	var imagArray = images.split(",");
	carusel();
	setInterval(function(){
		carusel();
	}, 5000);
	
	function carusel(){
		var rand = imagArray[Math.floor(Math.random() * imagArray.length)];
		
		changeImg("url('" + rand + "')");
	}

});

function changeImg(src){
	
	var imageTop = $("#imageTop");
	var imageBottom = $("#imageBottom");

	var srcTop = imageTop.css('background-image');
	var srcBottom = imageBottom.css('background-image');

	imageTop.css('opacity', 1);

	imageTop.css('background-image', srcBottom);
	imageBottom.css('background-image', src);

    imageTop.fadeTo( "slow", 0, function (){
    	imageTop.css('background-image', src);
    });
	
}
</script>