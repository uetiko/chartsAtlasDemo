/**
 * @author Angel Barrientos uetiko@gmail.com
 */

function initEvents(){
	getFecha();
	getMapLink();
}

function getFecha() {
	$.ajax({
		url : '../../../src/com.ife.chart.cgi/cgi.php',
		dataType : 'json',
		type : 'POST',
		data : {
			peticion : true,
			action : 'getFecha'
		},
		success : function(response, textStatus, jqXHR) {
			$("div#smalltext").empty();
			$("div#smalltext").html('<strong>' + response.fecha + '</strong>');
		},
		error : function(response, textStatus, jqXHR) {
			alert(textStatus);
		}
	});
}

function getMapLink() {
	$.ajax({
		url : '../../../src/com.ife.chart.cgi/cgi.php',
		dataType : 'json',
		type : 'POST',
		data : {
			peticion : true,
			action : 'mapGuide'
		},
		success : function(response, textStatus, jqXHR) {
			$("div#panel").empty();
			$("div#panel").html('<iframe name="window" src=' + response.link + ' marginwidth=0 width="960" height="755" scrolling="yes"></iframe>');
		},
		error : function(response, textStatus, jqXHR) {
			alert(textStatus);
		}
	});
}