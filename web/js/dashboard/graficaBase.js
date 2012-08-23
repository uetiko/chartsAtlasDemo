/**
 * @author Angel Barrientos uetiko@gmail.com
 * @license http://www.gnu.org/copyleft/lesser.html Distributed under the Lesser General Public License (LGPL)
 * @copyright 2012
 */

function initEvents() {
	setMapas();
	acordeon();
	menuMaps();
	/*
	 * getInfoBrowser() setPaisCombo(); cmpChange(); //chart();
	 */
}

function acordeon() {
	$( "#tabs" ).tabs({
		event: "mouseover"
	});
	$('#accordion').accordion({
		fillSpace : true
	});
	$(function() {
		$("#accordionResizer").resizable({
			minHeight : 140,
			resize : function() {
				$("#accordion").accordion("resize");
			}
		});
	});
	/*
	 * $('.accordion .head').click(function() { $(this).next().toggle('slow');
	 * return false; }).next().hide();
	 */
}

function menuMaps() {
	$('label').click(function() {
		var algo = $(this);
		var string = new String(algo[0].id);
		alert(string.toUpperCase());
		mesId(string);
	});
}

function mesId(id) {
	$.ajax({
		url : '../../../../src/com.ife.chart.cgi/cgi.php',
		dataType : 'json',
		type : 'POST',
		data : {
			peticion : true,
			action : 'showMapa',
			idMapa : id.toUpperCase()
		},
		success : function(response, statusText, jqXHR) {
			showMapImg(response.mapaPath[0], id);
			var datos = makeJson(response.grafica, id);
			Chart(datos);
		},
		error : function(response, stautsText, jqXHR) {
			alert('nel, dedicate a otra cosa! ' + statustext)
		}
	});
}

function showMapImg(json, id) {
	$('#map').html(
			'<img id="mapa" src="/chartsAtlasDemo/' + json.path + '/' + json.map_name + '" style="height: 595px; width: 900px;"/>');
}

function getInfoBrowser() {
	var ua = $.browser;
	if (ua.mozilla && ua.version.slice(0, 3) == "1.9") {
		alert("Do stuff for firefox 3");
	}
}

function makeJson(json, opt) {
	var datos;
	if (opt == 'octMay') {
		datos = {
			reporte : {
				nombreGrafica : "Mexicanos en el mundo",
				subnombre : "Número de mexicanos",
				categories : [ json.clave ],
				ejeYTitulo : "Lineas",
				unidadesY : 'Ciudadanos',
				ejeXTitulo : "Columnas",
				unidadesX : 'Ciudadanos',
				valores1 : {
					nombre : "Ciudadanos",
					datos : [ json.valor ]
				},
				valores2 : {
					nombre : "undef",
					datos : [  ]
				},
				totalCiudadanos : "Total de ciudadanos en este pais"
			}
		}
	} else {
		datos = {
			reporte : {
				nombreGrafica : "Mexicanos en el mundo",
				subnombre : "Número de mexicanos",
				categories : [ json.clave ],
				ejeYTitulo : "Lineas",
				unidadesY : 'Ciudadanos',
				ejeXTitulo : "Columnas",
				unidadesX : 'Ciudadanos',
				valores1 : {
					nombre : "Ciudadanos",
					datos : [ json.valor ]
				},
				valores2 : {
					nombre : "undef",
					datos : [  ]
				},
				totalCiudadanos : "Total de ciudadanos en este pais"
			}
		}
	}
	return datos;
}

function Chart(datos) {
	var paises = new String();
	var numbers;
	
	var jsonVar;
	var totalMencion = 0;
	var totalTiempo = 0;
	var tmp = datos.reporte;
	var size = datos.reporte.valores1.datos[0].length;
	for ( var i = 0; i < size; i++) {
		totalMencion = totalMencion + parseInt(datos.reporte.valores1.datos[i]);
		totalTiempo = totalTiempo + parseInt(datos.reporte.valores2.datos[i]);
	}

	chart = new Highcharts.Chart(
			{
				chart : {
					renderTo : 'container',
					zoomType : 'xy'
				},
				title : {
					text : tmp.nombreGrafica
				},
				subtitle : {
					text : tmp.totalCiudadanos + ': ' + totalMencion,
					style : {
						color : '#b25c3f'
					}
				},
				xAxis : [ {
					categories : tmp.categories[0]
				} ],
				labels : {
					rotation : -45,
					align : 'right'
				},
				yAxis : [ { // Primary yAxis
					labels : {
						formatter : function() {
							return this.value + ' ' + tmp.unidadesY;
						},
						style : {
							color : '#6c6d6d'
						}
					},
					title : {
						text : tmp.ejeYTitulo,
						style : {
							color : '#982117'
						}
					}
				}, { // Secondary yAxis
					title : {
						text : tmp.ejeXTitulo,
						style : {
							color : '#982117'
						}
					},
					labels : {
						formatter : function() {
							return this.value + ' ' + tmp.unidadesX;
						},
						style : {
							color : '#6c6d6d'
						}
					},
					opposite : true
				} ],
				tooltip : {
					formatter : function() {
						return '<b>' + this.x + '</b><br/>' + this.series.name
								+ ': ' + this.y;
					},
					backgroundColor : {
						linearGradient : [ 0, 0, 0, 60 ],
						stops : [ [ 0, '#FFFFFF' ], [ 1, '#d4aab9' ] ]
					},
					borderWidth : 1,
					borderColor : '#AAA',
					shadow : true,
					style : {
						color : '#69696a',
						fontSize : '9pt',
						padding : '5px'
					}
				},

				plotOptions : {
					column : {
						stacking : 'normal',
						dataLabels : {
							enabled : true,
							color : (Highcharts.theme && Highcharts.theme.dataLabelsColor)
									|| 'white'
						}
					}
				},

				legend : {
					layout : 'horizontal',
					align : 'left',
					itemWidth : 120,
					x : 100,
					verticalAlign : 'top',
					y : 35,
					floating : true,
					backgroundColor : Highcharts.theme.legendBackgroundColor
							|| '#FFFFFF'
				},
				series : [ {
					name : tmp.ejeXTitulo,
					color : '#66263d',
					type : 'column',
					stack : 'partidos',
					yAxis : 1,
					data : tmp.valores1.datos[0]
				}, {
					name : tmp.ejeYTitulo,
					color : '#bf7548',
					type : 'spline',
					stack : 'tiempos',
					data : tmp.valores1.datos[0]
				} ]
			});
}

function cmpChange() {
	$("select#paisCmb").change(function() {
		$("div#container").empty();
		$.ajax({
			url : '../../../src/com.ife.chart.cgi/cgi.php',
			dataType : 'json',
			type : 'POST',
			data : {
				peticion : true,
				action : 'getMese',
				idmes : $('select#paisCmb option:selected').val()
			},
			success : function(response, textStatus, jqXHR) {
				var keyEstado = new Array();
				var key = new Array();
				var e = 0;
				var num = new Array();
				for ( var iterable in response.estado) {
					key[e] = iterable;
					e++;
				}
				for ( var int = 0; int < key.length; int++) {
					keyEstado[int] = response.estado[key[int]];

				}

				for ( var int = 0; int < key.length; int++) {
					num[int] = parseInt(response.numeros[int]);

				}
				Chart(keyEstado, num);

			},
			error : function(response, textStatus, jqXHR) {
				alert(textStatus);
			}
		});
	});
}

function setMapas() {
	$.ajax({
		url : '../../../../src/com.ife.chart.cgi/cgi.php',
		dataType : 'json',
		type : 'POST',
		data : {
			peticion : true,
			action : 'getMapas'
		},
		success : function(response, textStatus, jqXHR) {
			var mapaCmb = $("select#mapaCmb");
			// alert(response[0][4]);
			mapaCmb.hide();
			mapaCmb.append(new Option("Selecciona un país"));
			for ( var i = 0; i < response.length; i++) {
				mapaCmb.append(new Option(response[i][4], response[i][1]));
			}
			mapaCmb.show();
		},
		error : function(response, textStatus, jqXHR) {
			alert(textStatus);
		}
	});
}

function setcombo() {
	$.ajax({
		url : '../src/com.ife.chart.cgi/cgi.php',
		dataType : 'json',
		type : 'POST',
		data : {
			peticion : true,
			action : 'getPais'
		},
		success : function(response, textStatus, jqXHR) {
			var paisCmb = $("select#paisCmb");
			paisCmb.hide();
			paisCmb.append(new Option("Selecciona un país"));
			for ( var i = 0; i < response.length; i++) {
				paisCmb.append(new Option(response[i].nombre,
						response[i].idPais));
			}
			paisCmb.show();
		},
		error : function(response, textStatus, jqXHR) {
			alert(textStatus);
		}
	});

}

/**
 * Dark blue theme for Highcharts JS
 * 
 * @author Torstein Hønsi
 */

Highcharts.theme = {
	colors : [ "#DDDF0D", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee",
			"#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee" ],
	chart : {
		backgroundColor : {
			linearGradient : [ 0, 0, 250, 500 ],
			stops : [ [ 0, '#dadada' ], [ 1, '#dadada' ] ]
		},
		borderColor : '#FFFFFF',
		borderWidth : 0,
		className : 'dark-container',
		plotBackgroundColor : '#b2b2b2',
		plotBorderColor : '#FFFFFF',
		plotBorderWidth : 1,
		plotShadow : true
	},
	title : {
		style : {
			color : '#FFFFFF',
			font : 'bold 16px "Trebuchet MS", Verdana, sans-serif'
		}
	},
	subtitle : {
		style : {
			color : '#666666',
			font : 'bold 12px "Trebuchet MS", Verdana, sans-serif'
		}
	},
	xAxis : {

		lineColor : '#A0A0A0',
		tickColor : '#A0A0A0',
		title : {
			style : {
				color : '#CCC',
				fontWeight : 'bold',
				fontSize : '12px',
				fontFamily : 'Trebuchet MS, Verdana, sans-serif'

			}
		}
	},
	yAxis : {
		gridLineColor : '#ffffff',
		labels : {
			style : {
				color : '#A0A0A0'
			}
		},
		lineColor : '#ffffff',
		minorTickInterval : null,
		tickColor : '#ffffff',
		tickWidth : 1,
		title : {
			style : {
				color : '#ffffff',
				fontWeight : 'bold',
				fontSize : '12px',
				fontFamily : 'Trebuchet MS, Verdana, sans-serif'
			}
		}
	},
	legend : {
		itemStyle : {
			font : '9pt Trebuchet MS, Verdana, sans-serif',
			color : '#A0A0A0'
		}
	},
	tooltip : {
		backgroundColor : 'rgba(0, 0, 0, 0.75)',
		style : {
			color : '#F0F0F0'
		}
	},
	toolbar : {
		itemStyle : {
			color : 'silver'
		}
	},
	plotOptions : {
		line : {
			dataLabels : {
				color : '#CCC'
			},
			marker : {
				lineColor : '#333'
			}
		},
		spline : {
			marker : {
				lineColor : '#333'
			}
		},
		scatter : {
			marker : {
				lineColor : '#333'
			}
		},
		candlestick : {
			lineColor : 'white'
		}
	},
	legend : {
		itemStyle : {
			color : '#CCC'
		},
		itemHoverStyle : {
			color : '#FFF'
		},
		itemHiddenStyle : {
			color : '#444'
		}
	},
	credits : {
		style : {
			color : '#666'
		}
	},
	labels : {
		style : {
			color : '#CCC'
		}
	},

	navigation : {
		buttonOptions : {
			backgroundColor : {
				linearGradient : [ 0, 0, 0, 20 ],
				stops : [ [ 0.4, '#606060' ], [ 0.6, '#333333' ] ]
			},
			borderColor : '#000000',
			symbolStroke : '#C0C0C0',
			hoverSymbolStroke : '#FFFFFF'
		}
	},

	exporting : {
		buttons : {
			exportButton : {
				symbolFill : '#55BE3B'
			},
			printButton : {
				symbolFill : '#7797BE'
			}
		}
	},

	// scroll charts
	rangeSelector : {
		buttonTheme : {
			fill : {
				linearGradient : [ 0, 0, 0, 20 ],
				stops : [ [ 0.4, '#888' ], [ 0.6, '#555' ] ]
			},
			stroke : '#000000',
			style : {
				color : '#CCC',
				fontWeight : 'bold'
			},
			states : {
				hover : {
					fill : {
						linearGradient : [ 0, 0, 0, 20 ],
						stops : [ [ 0.4, '#BBB' ], [ 0.6, '#888' ] ]
					},
					stroke : '#000000',
					style : {
						color : 'white'
					}
				},
				select : {
					fill : {
						linearGradient : [ 0, 0, 0, 20 ],
						stops : [ [ 0.1, '#000' ], [ 0.3, '#333' ] ]
					},
					stroke : '#000000',
					style : {
						color : 'yellow'
					}
				}
			}
		},
		inputStyle : {
			backgroundColor : '#333',
			color : 'silver'
		},
		labelStyle : {
			color : 'silver'
		}
	},

	navigator : {
		handles : {
			backgroundColor : '#666',
			borderColor : '#AAA'
		},
		outlineColor : '#CCC',
		maskFill : 'rgba(16, 16, 16, 0.5)',
		series : {
			color : '#7798BF',
			lineColor : '#A6C7ED'
		}
	},

	scrollbar : {
		barBackgroundColor : {
			linearGradient : [ 0, 0, 0, 20 ],
			stops : [ [ 0.4, '#888' ], [ 0.6, '#555' ] ]
		},
		barBorderColor : '#CCC',
		buttonArrowColor : '#CCC',
		buttonBackgroundColor : {
			linearGradient : [ 0, 0, 0, 20 ],
			stops : [ [ 0.4, '#888' ], [ 0.6, '#555' ] ]
		},
		buttonBorderColor : '#CCC',
		rifleColor : '#FFF',
		trackBackgroundColor : {
			linearGradient : [ 0, 0, 0, 10 ],
			stops : [ [ 0, '#000' ], [ 1, '#333' ] ]
		},
		trackBorderColor : '#666'
	},

	// special colors for some of the
	legendBackgroundColor : 'rgba(0, 0, 0, 0.5)',
	legendBackgroundColorSolid : 'rgb(35, 35, 70)',
	dataLabelsColor : '#444',
	textColor : '#C0C0C0',
	maskColor : 'rgba(255,255,255,0.3)'
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
