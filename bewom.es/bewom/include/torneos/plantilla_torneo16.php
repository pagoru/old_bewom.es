<style>
#torneo {
	display: table-cell;
}
#cube {
	background-color: #F9F9F9;
	display: table-cell;
	width: 102px;
	font-size: 14px;
	border-bottom: 2px solid #808080;
	padding: 4px;
	float: left;
	margin-bottom: 4px;
}

#vs {

	float: left;
	width: 34px;
	text-align: center;
	margin-top: 8px;

}

#ganadorName{

	float: left;
	text-align: center;
	margin-top: 8px;
	margin-left: 8px;
	
}

.lastPostImage {
    width: 26px;
    height: 26px;
    border: 4px solid;
    padding: 0px;
    float: left;
    box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.75) inset;
}

#fases{

	float: left;
	display: table-cell;
	width: 112px;
	margin-right: 20px;

}

#ganadores{

	float: left;
	display: table-cell;
	width: 100%;
	margin-bottom: 8px;

}

.nameHover {
	position: absolute;
	background-color: #333;
	margin-top: -28px;
	margin-left: 30px;
	padding: 4px;
	border-radius: 6px 6px 6px 0px;
	font-weight: bold;
	color: #FFF;
	box-shadow: 4px 4px 0px 0px rgba(105, 105, 105, 0.5);
}

#title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 4px;
    letter-spacing: -1px;
    margin-left: 4px;
    margin-right: 8px;
    float: left;
}

#divSelector{
	width: 350px;
	float: left;
	display: table-cell;
	border-right: 4px solid #C3C3C3;
	margin-right: 4px;
}
#divTorneo{
	float: left;
}
#insideDiv{
	display: table-cell;
}
.selector{
	background-color: #F9F9F9;
	border-bottom: 2px solid #808080;
	padding: 4px;
	width: 162px;
	text-align: center;
	font-size: 14px;
	font-weight: bold;
	float: left;
	margin-right: 4px;
	margin-top: 4px;
	cursor: pointer;
}
.selected {
	background-color: #808080;
	border-bottom: 2px solid rgba(0, 0, 0, 0.75);
	color: #fff;
}
#diaHora{
	font-size: 22px;
	font-weight: bold;
	margin-bottom: 4px;
	letter-spacing: -2px;
	color: rgb(128, 128, 128);
}
</style>
<div id="divSelector">
	<?php
	$count = getCountTorneos();
	?>
	<?php for ($i = $count; $i > 0; $i--):?>
	<div id="selector<?php echo $i;?>" class="selector">Torneo <?php echo $i;?></div>
	<?php endfor;?>
</div>
<div id="divTorneo">
	<script>
	<?php include 'torneo.js';?>
		var torneo = <?php echo $count;?>;
		$("#selector<?php echo $count;?>").addClass("selected");
		setTorneo(torneo);

		var max = <?php echo $count?>;
		<?php for ($i = $count; $i > 0; $i--):?>
		$("#selector<?php echo $i;?>").click(function(){
			torneo = "<?php echo $i?>";
			for (var i = max; i > 0; i--) { 
				$("#selector" + i).removeClass("selected");
			}
			$(this).addClass("selected");
			setTorneo(torneo);
		});
		<?php endfor;?>
		setInterval(function(){
			setTorneo(torneo);
		}, 5000);
	</script>
	<div id="title"></div><div id="diaHora">(14 Sep 15 20:00)</div>
	<div id="ganadores">
		<div id="cube" style="width: 158px; margin-right: 4px; background-color: #FFB41D; border-bottom: 2px solid #805A0F;">
			<a id="oroLink">
				<div class="lastPostImage" id="oroBack"></div>
				<div id="ganadorName"><b id="oroName"></b></div>
			</a>
		</div>
		<div id="cube" style="width: 158px; margin-right: 4px; background-color: #AAA; border-bottom: 2px solid #2B2B2B;">
			<a id="plataLink">
				<div class="lastPostImage" id="plataBack"></div>
				<div id="ganadorName"><b id="plataName"></b></div>
			</a>
		</div>
		<div id="cube" style="width: 158px; margin-right: 4px; background-color: #EF7533; border-bottom: 2px solid #703718;">
			<a id="cobreLink">
				<div class="lastPostImage" id="cobreBack"></div>
				<div id="ganadorName"><b id="cobreName"></b></div>
			</a>
		</div>
	</div>
	<div id="torneo">
		<div id="fases">
		<?php for ($i = 0; $i < 8; $i++): ?>
			<div id="cube">
				<a id="f0_0_<?php echo $i;?>">
					<div class="lastPostImage">
						<div id="hover_f0_0_<?php echo $i;?>" class="nameHover"></div>
					</div>
				</a>
				<div id="vs"><b>vs</b></div>
				
				<a id="f0_1_<?php echo $i;?>">
					<div class="lastPostImage">
						<div id="hover_f0_1_<?php echo $i;?>" class="nameHover"></div>
					</div>
				</a>
			</div>
		<?php endfor; ?>
		</div>
		
		<div id="fases">
			<?php for ($i = 0; $i < 4; $i++):?>
			<?php 
			
			$marginTop = "48";
			
			if($i == 0 ){
				
				$marginTop = "24";
				
			}
			
			?>
			<div id="cube" style="margin-top: <?php echo $marginTop;?>px;">
				<a id="f1_0_<?php echo $i;?>">
					<div class="lastPostImage">
						<div id="hover_f1_0_<?php echo $i;?>" class="nameHover"></div>			
					</div>
				</a>
				
				<div id="vs"><b>vs</b></div>
				
				<a id="f1_1_<?php echo $i;?>">
					<div class="lastPostImage ">
						<div id="hover_f1_1_<?php echo $i;?>" class="nameHover"></div>
					</div>
				</a>
			</div>
			<?php endfor;?>
		</div>
		
		<div id="fases">
			<div id="cube" style="margin-top: 72px;">
				<a id="f2_0_0">
					<div class="lastPostImage">
						<div id="hover_f2_0_0" class="nameHover"></div>
					</div>
				</a>
				
				<div id="vs"><b>vs</b></div>
				
				<a id="f2_1_0">
					<div class="lastPostImage">
						<div id="hover_f2_1_0" class="nameHover"></div>
					</div>
				</a>
			</div>
			<div id="cube" style="margin-top: 144px;">
				<a id="f2_0_1">
					<div class="lastPostImage">
						<div id="hover_f2_0_1" class="nameHover"></div>
					</div>
				</a>
					
				<div id="vs"><b>vs</b></div>
				
				<a id="f2_1_1">
					<div class="lastPostImage">
						<div id="hover_f2_1_1" class="nameHover"></div>
					</div>
				</a>
			</div>
		</div>
		
		<div id="fases" style="margin-right: 0px;">
			<div id="cube" style="margin-top: 168px;">
				<a id="f3_0_0">
					<div class="lastPostImage">
						<div id="hover_f3_0_0" class="nameHover"></div>
					</div>
				</a>
				
				<div id="vs"><b>vs</b></div>
				
				<a id="f3_1_0">
					<div class="lastPostImage">
						<div id="hover_f3_1_0" class="nameHover"></div>
					</div>
				</a>
			</div>
			
			<div id="cube" style="margin-top: 120px;"> <!-- Tercer puesto -->
				<a id="ft_0">
					<div class="lastPostImage">
						<div id="hover_ft_0" class="nameHover"></div>
					</div>
				</a>
				
				<div id="vs"><b>vs</b></div>
				
				<a id="ft_1">
					<div class="lastPostImage">
						<div id="hover_ft_1" class="nameHover"></div>
					</div>
				</a>
			</div>
			
		</div>
	</div>
	
	<script>
	
	<?php for ($j = 0; $j < 4; $j++):?>
		<?php for ($i = 0; $i < 8; $i++):?>
		
		$("#hover_f<?php echo $j;?>_0_<?php echo $i;?>").hide();
		$("#hover_f<?php echo $j;?>_1_<?php echo $i;?>").hide();
		
		$("#f<?php echo $j;?>_0_<?php echo $i;?>").hover(
		  function() {
		    $("#hover_f<?php echo $j;?>_0_<?php echo $i;?>").show();
		  }, function() {
			  $("#hover_f<?php echo $j;?>_0_<?php echo $i;?>").hide();
		  }
		);
		
		$("#f<?php echo $j;?>_1_<?php echo $i;?>").hover(
			function() {
		    $("#hover_f<?php echo $j;?>_1_<?php echo $i;?>").show();
		  }, function() {
			  $("#hover_f<?php echo $j;?>_1_<?php echo $i;?>").hide();
		  }
		);
		
		<?php endfor;?>
	<?php endfor;?>

	<?php for ($k = 0; $k < 2; $k++):?>
	
		$("#hover_ft_<?php echo $k;?>").hide();
		
		$("#ft_<?php echo $k;?>").hover(
		  function() {
		    $("#hover_ft_<?php echo $k;?>").show();
		  }, function() {
			  $("#hover_ft_<?php echo $k;?>").hide();
		  }
			
		);

	<?php endfor;?>
	
	</script>
</div>