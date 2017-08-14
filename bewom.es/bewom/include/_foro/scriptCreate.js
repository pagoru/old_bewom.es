function hideScrollBar(){
	$('html, body').css({
	    'overflow': 'hidden',
	    'height': '100%'
	});
}

function showhideScrollBar(){
	$('html, body').css({
	    'overflow': 'auto',
	    'height': 'auto'
	});
}

function showCreateBox(){
	hideScrollBar();
	$("#background-absolute").show();
	$("#box-absolute").show();
}

function hideCreateBox(){
	showhideScrollBar();
	$("#background-absolute").hide();
	$("#box-absolute").hide();
}

function emptyCreateBoxText(){
	$("#textarea").val("");
	$("#preview").text("");
}

function updateTextArea(){
	var firma = $('#textarea').val();
	firma = nl2br(firma.replace(/"/g, "''"));
	$.post("http://bewom.es/test/foro_message_2/", { p: firma }, function(data) {
		$("#preview").html(data);
	});

	$a = 5120 - $('#textarea').val().length;
	if($a < 0 || $a == 5120){
		$("#crear").prop('disabled', true);
	} else {
		$("#crear").prop('disabled', false);
	}
	$("#restante").html($a + " carácteres restantes.");
}

if($("#background-absolute").css('display') != 'none'){
	hideScrollBar();
}

$("#background-absolute").click(function(){
	hideCreateBox();
});

updateTextArea();
$("#crear").prop('disabled', true);

$('#textarea').keyup(function (e) {
	updateTextArea();
});

$("#crear").hover(function (e) {
	updateTextArea();
	$a = 5120 - $("#textarea").val().length;
	if($a < 0 || $a == 5120){
		$(this).prop('disabled', true);
	} else {
		$(this).prop('disabled', false);
	}
	$("#restante").html($a + " carácteres restantes.");
	return;
});

$("#crear").click(function (e) {
	hideCreateBox();
	return;
});

//function post(path, params, method) {
//    method = method || "post"; // Set method to post by default if not specified.
//
//    // The rest of this code assumes you are not using a library.
//    // It can be made less wordy if you use one.
//    var form = document.createElement("form");
//    form.setAttribute("method", method);
//    form.setAttribute("action", path);
//
//    for(var key in params) {
//        if(params.hasOwnProperty(key)) {
//            var hiddenField = document.createElement("input");
//            hiddenField.setAttribute("type", "hidden");
//            hiddenField.setAttribute("name", key);
//            hiddenField.setAttribute("value", params[key]);
//
//            form.appendChild(hiddenField);
//         }
//    }
//
//    document.body.appendChild(form);
//    form.submit();
//}

function nl2br(str, is_xhtml) {
	  //  discuss at: http://phpjs.org/functions/nl2br/
	  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  // improved by: Philip Peterson
	  // improved by: Onno Marsman
	  // improved by: Atli Þór
	  // improved by: Brett Zamir (http://brett-zamir.me)
	  // improved by: Maximusya
	  // bugfixed by: Onno Marsman
	  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  //    input by: Brett Zamir (http://brett-zamir.me)
	  //   example 1: nl2br('Kevin\nvan\nZonneveld');
	  //   returns 1: 'Kevin<br />\nvan<br />\nZonneveld'
	  //   example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
	  //   returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
	  //   example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
	  //   returns 3: '<br />\nOne<br />\nTwo<br />\n<br />\nThree<br />\n'

	  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

	  return (str + '')
	    .replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	}
