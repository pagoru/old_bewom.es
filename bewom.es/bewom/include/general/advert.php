<div class="ader-players">
	<div class="ader-inside">
		<a href="<?php echo WEB;?>foro/Noticias/235/">
			<div id="add" style="background-image: url('<?php echo WEB;?>assets/adv/default.png');"></div>
		</a>
	</div>
</div>
<?php
$d2 = scandir("assets/adv");
$i3 = 0;
foreach($d2 as $img2){
	if(strpos($img2, ".png")){
		$images2 = $images2."assets/adv/".$img2.",";
		$i3++;
	}
}
$images2 = substr($images2, 0, strlen($images2) - 1);
?>
<script>
jQuery(window).load(function () {
	
	caruselAdv();
	setInterval(function(){
		caruselAdv();
	}, 5000);
	
	function caruselAdv(){
		
		var images2 = "<?php echo $images2;?>";
		var imagArray2 = images2.split(",");
		
		var rand = imagArray2[Math.floor(Math.random() * imagArray2.length)];
		changeImgAdv("url('" + rand + "')");
	}

});

function changeImgAdv(src){
	$("#add").css('background-image', src);
}
</script>