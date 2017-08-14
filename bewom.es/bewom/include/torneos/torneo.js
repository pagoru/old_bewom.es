function setTorneo(torneoNum){
	$.get("test/torneos/" + torneoNum, function(data) {
		var info = data.split(";");
		
		var name = info[0];
		$("#title").html(name);
		
		var hour = info[1];
		dateParts = hour.split(" ");
		timeParts = dateParts[1].split(":");
		dateParts = dateParts[0].split("-");
		
		year = dateParts[0].substring(2,4);
		
		$("#diaHora").html("(" + dateParts[2] + "/" + dateParts[1] + "/" + year + " - " + timeParts[0] + ":" + timeParts[1] + ")");
		
		var players = info[3].split(",");
		var ronda1 = info[4].split(",");
		var ronda2 = info[5].split(",");
		var ronda3 = info[6].split(",");
		var ronda4 = info[7];
		
		var x = 0;
		var y = 0;
		
		for (var i = 0; i < 8; i++) {
			$("#f0_0_" + i).children().css("background", " transparent url('https://minotar.net/helm/" + players[(i*2)] + "/26') no-repeat scroll 0% 0%");
			$("#f0_0_" + i).attr("href", "perfil/" + players[(i*2)]);
			$("#hover_f0_0_" + i).html(players[(i*2)]);
			
			$("#f0_1_" + i).children().css("background", " transparent url('https://minotar.net/helm/" + players[(i*2) + 1] + "/26') no-repeat scroll 0% 0%");
			$("#f0_1_" + i).attr("href", "perfil/" + players[(i*2) + 1]);
			$("#hover_f0_1_" + i).html(players[(i*2) + 1]);

			if(ronda1[i] == 1){
				$("#f0_0_" + i).children().css("background", "url('../assets/Barrier.png') no-repeat scroll -3px -3px, transparent url('https://minotar.net/helm/" + players[(i*2)] + "/26') no-repeat scroll 0% 0%");
			} else if(ronda1[i] == 0){
				$("#f0_1_" + i).children().css("background", "url('../assets/Barrier.png') no-repeat scroll -3px -3px, transparent url('https://minotar.net/helm/" + players[(i*2) + 1] + "/26') no-repeat scroll 0% 0%");
			}
			
			var player0 = $("#hover_f0_0_" + i).text();
			var player1 = $("#hover_f0_1_" + i).text();
			if(i%2 == 0){
				if(ronda1[i] == 0){
					$("#f1_0_" + x).children().css("background", " transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
					$("#f1_0_" + x).attr("href", "perfil/" + player0);
					$("#hover_f1_0_" + x).html(player0);
				} else if(ronda1[i] == 1) {
					$("#f1_0_" + x).children().css("background", " transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
					$("#f1_0_" + x).attr("href", "perfil/" + player1);
					$("#hover_f1_0_" + x).html(player1);
				} else {
					$("#f1_0_" + x).children().css("background", "");
					$("#f1_0_" + x).attr("href", "");
					$("#hover_f1_0_" + x).html();
				}
				x++;
			} else {
				if(ronda1[i] == 0){
					$("#f1_1_" + y).children().css("background", " transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
					$("#f1_1_" + y).attr("href", "perfil/" + player0);
					$("#hover_f1_1_" + y).html(player0);
				} else if(ronda1[i] == 1) {
					$("#f1_1_" + y).children().css("background", " transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
					$("#f1_1_" + y).attr("href", "perfil/" + player1);
					$("#hover_f1_1_" + y).html(player1);
				} else {
					$("#f1_1_" + y).children().css("background", "");
					$("#f1_1_" + y).attr("href", "");
					$("#hover_f1_1_" + y).html();
				}
				y++;
			}
		}

		x = 0;
		y = 0;
		
		for (i = 0; i < 4; i++) {				
			player0 = $("#hover_f1_0_" + i).text();
			player1 = $("#hover_f1_1_" + i).text();
			if(ronda2[i] == 1){
				$("#f1_0_" + i).children().css("background", "url('../assets/Barrier.png') no-repeat scroll -3px -3px, transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
			} else if(ronda2[i] == 0){
				$("#f1_1_" + i).children().css("background", "url('../assets/Barrier.png') no-repeat scroll -3px -3px, transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
			}
			if(i%2 == 0){
				if(ronda2[i] == 0){
					$("#f2_0_" + x).children().css("background", " transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
					$("#f2_0_" + x).attr("href", "perfil/" + player0);
					$("#hover_f2_0_" + x).html(player0);
				} else if(ronda2[i] == 1) {
					$("#f2_0_" + x).children().css("background", " transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
					$("#f2_0_" + x).attr("href", "perfil/" + player1);
					$("#hover_f2_0_" + x).html(player1);
				} else {
					$("#f2_0_" + x).children().css("background", "");
					$("#f2_0_" + x).attr("href", "");
					$("#hover_f2_0_" + x).html();
				}
				x++;
			} else {
				if(ronda2[i] == 0){
					$("#f2_1_" + y).children().css("background", " transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
					$("#f2_1_" + y).attr("href", "perfil/" + player0);
					$("#hover_f2_1_" + y).html(player0);
				} else if(ronda2[i] == 1) {
					$("#f2_1_" + y).children().css("background", " transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
					$("#f2_1_" + y).attr("href", "perfil/" + player1);
					$("#hover_f2_1_" + y).html(player1);
				} else {
					$("#f2_1_" + y).children().css("background", "");
					$("#f2_1_" + y).attr("href", "");
					$("#hover_f2_1_" + y).html();
				}
				y++;
			}
		}

		x = 0;
		y = 0;

		for (i = 0; i < 2; i++) {			
			player0 = $("#hover_f2_0_" + i).text();
			player1 = $("#hover_f2_1_" + i).text();
			if(ronda3[i] == 1){
				$("#f2_0_" + i).children().css("background", "url('../assets/Barrier.png') no-repeat scroll -3px -3px, transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
			} else if(ronda3[i] == 0){
				$("#f2_1_" + i).children().css("background", "url('../assets/Barrier.png') no-repeat scroll -3px -3px, transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
			}
			if(i%2 == 0){
				if(ronda3[i] == 0){
					$("#f3_0_" + x).children().css("background", " transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
					$("#f3_0_" + x).attr("href", "perfil/" + player0);
					$("#hover_f3_0_" + x).html(player0);
				} else if(ronda3[i] == 1) {
					$("#f3_0_" + x).children().css("background", " transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
					$("#f3_0_" + x).attr("href", "perfil/" + player1);
					$("#hover_f3_0_" + x).html(player1);
				} else {
					$("#f3_0_" + x).children().css("background", "");
					$("#f3_0_" + x).attr("href", "");
					$("#hover_f3_0_" + x).html();
				}
				x++;
			} else {
				if(ronda3[i] == 0){
					$("#f3_1_" + y).children().css("background", " transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
					$("#f3_1_" + y).attr("href", "perfil/" + player0);
					$("#hover_f3_1_" + y).html(player0);
				} else if(ronda3[i] == 1) {
					$("#f3_1_" + y).children().css("background", " transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
					$("#f3_1_" + y).attr("href", "perfil/" + player1);
					$("#hover_f3_1_" + y).html(player1);
				} else {
					$("#f3_1_" + y).children().css("background", "");
					$("#f3_1_" + y).attr("href", "");
					$("#hover_f3_1_" + y).html();
				}
				y++;
			}
		}

		playerA = $("#hover_f2_0_0").text();
		playerB = $("#hover_f2_1_0").text();
		playerC = $("#hover_f2_0_1").text();
		playerD = $("#hover_f2_1_1").text();
		
		player0 = $("#hover_f3_1_0").text();
		player1 = $("#hover_f3_0_0").text();
		if(ronda4 == 0){
			removeGolds();
			$("#f3_1_0").children().css("background", "url('../assets/Barrier.png') no-repeat scroll -3px -3px, transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
			$("#oroName").html(player1);
			$.get("test/public_perms/" + player1, function(data) {
				$("#oroBack").addClass(data);
			});
			$("#oroLink").attr("href", "perfil/" + player1);
			$("#oroBack").css("background", " transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
			$("#plataName").html(player0);
			$.get("test/public_perms/" + player0, function(data) {
				$("#plataBack").addClass(data);
			});
			$("#plataLink").attr("href", "perfil/" + player0);
			$("#plataBack").css("background", " transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");

			if(playerA == player1){
				$("#cobreName").html(playerB);
				$.get("test/public_perms/" + playerB, function(data) {
					$("#cobreBack").addClass(data);
				});
				$("#cobreLink").attr("href", "perfil/" + playerB);
				$("#cobreBack").css("background", " transparent url('https://minotar.net/helm/" + playerB + "/26') no-repeat scroll 0% 0%");
			}
			if(playerB == player1){
				$("#cobreName").html(playerA);
				$.get("test/public_perms/" + playerA, function(data) {
					$("#cobreBack").addClass(data);
				});
				$("#cobreLink").attr("href", "perfil/" + playerA);
				$("#cobreBack").css("background", " transparent url('https://minotar.net/helm/" + playerA + "/26') no-repeat scroll 0% 0%");
			}
			if(playerC == player1){
				$("#cobreName").html(playerD);
				$.get("test/public_perms/" + playerD, function(data) {
					$("#cobreBack").addClass(data);
				});
				$("#cobreLink").attr("href", "perfil/" + playerD);
				$("#cobreBack").css("background", " transparent url('https://minotar.net/helm/" + playerD + "/26') no-repeat scroll 0% 0%");
			}
			if(playerD == player1){
				$("#cobreName").html(playerC);
				$.get("test/public_perms/" + playerC, function(data) {
					$("#cobreBack").addClass(data);
				});
				$("#cobreLink").attr("href", "perfil/" + playerC);
				$("#cobreBack").css("background", " transparent url('https://minotar.net/helm/" + playerC + "/26') no-repeat scroll 0% 0%");
			}
			
		} else if(ronda4 == 1){
			removeGolds();
			$("#f3_0_0").children().css("background", "url('../assets/Barrier.png') no-repeat scroll -3px -3px, transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");
			$("#oroName").html(player0);
			$.get("test/public_perms/" + player0, function(data) {
				$("#oroBack").addClass(data);
			});
			$("#oroLink").attr("href", "perfil/" + player0);
			$("#oroBack").css("background", " transparent url('https://minotar.net/helm/" + player0 + "/26') no-repeat scroll 0% 0%");
			$("#plataName").html(player1);
			$.get("test/public_perms/" + player1, function(data) {
				$("#plataBack").addClass(data);
			});
			$("#plataLink").attr("href", "perfil/" + player1);
			$("#plataBack").css("background", " transparent url('https://minotar.net/helm/" + player1 + "/26') no-repeat scroll 0% 0%");

			if(playerA == player0){
				$("#cobreName").html(playerB);
				$.get("test/public_perms/" + playerB, function(data) {
					$("#cobreBack").addClass(data);
				});
				$("#cobreLink").attr("href", "perfil/" + playerB);
				$("#cobreBack").css("background", " transparent url('https://minotar.net/helm/" + playerB + "/26') no-repeat scroll 0% 0%");
			}
			if(playerB == player0){
				$("#cobreName").html(playerA);
				$.get("test/public_perms/" + playerA, function(data) {
					$("#cobreBack").addClass(data);
				});
				$("#cobreLink").attr("href", "perfil/" + playerA);
				$("#cobreBack").css("background", " transparent url('https://minotar.net/helm/" + playerA + "/26') no-repeat scroll 0% 0%");
			}
			if(playerC == player0){
				$("#cobreName").html(playerD);
				$.get("test/public_perms/" + playerD, function(data) {
					$("#cobreBack").addClass(data);
				});
				$("#cobreLink").attr("href", "perfil/" + playerD);
				$("#cobreBack").css("background", " transparent url('https://minotar.net/helm/" + playerD + "/26') no-repeat scroll 0% 0%");
			}
			if(playerD == player0){
				$("#cobreName").html(playerC);
				$.get("test/public_perms/" + playerC, function(data) {
					$("#cobreBack").addClass(data);
				});
				$("#cobreLink").attr("href", "perfil/" + playerC);
				$("#cobreBack").css("background", " transparent url('https://minotar.net/helm/" + playerC + "/26') no-repeat scroll 0% 0%");
			}
		} else {
			removeGolds();
		}
		
		for (var a = 0; a < 8; a++) {
			for (var b = 0; b < 2; b++) {
				for (var c = 0; c < 4; c++) {
					var player = $("#hover_f" + c + "_" + b + "_" + a).text();
					$.get("test/public_perms/" + player + "/" + a + "/" + b + "/" + c, function(data) {
						var dat = data.split("/");
						var clas = $("#f" + dat[3] + "_" + dat[2] + "_" + dat[1]);
						clas.children().removeClass("null");
						clas.children().removeClass("admin");
						clas.children().removeClass("vip");
						clas.children().removeClass("miembro");
						clas.children().addClass(dat[0]);
					});
				}
			}
		}
	});
}

function removeGolds(){
	$("#oroName").html("");
	$("#oroLink").attr("href", "");
	$("#oroBack").css("background", "");
	$("#plataName").html("");
	$("#plataLink").attr("href", "");
	$("#plataBack").css("background", "");
	$("#cobreName").html("");
	$("#cobreLink").attr("href", "");
	$("#cobreBack").css("background", "");
	
	$("#oroBack").removeClass("null");
	$("#oroBack").removeClass("admin");
	$("#oroBack").removeClass("vip");
	$("#oroBack").removeClass("miembro");
	
	$("#plataBack").removeClass("null");
	$("#plataBack").removeClass("admin");
	$("#plataBack").removeClass("vip");
	$("#plataBack").removeClass("miembro");
	
	$("#cobreBack").removeClass("null");
	$("#cobreBack").removeClass("admin");
	$("#cobreBack").removeClass("vip");
	$("#cobreBack").removeClass("miembro");
}