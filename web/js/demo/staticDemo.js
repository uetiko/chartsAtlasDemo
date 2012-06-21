/**
 * @author Angel Barrientos <uetiko@gmail.com>
 * Demo sin colesterol.
 */

function initEvents() {
	chart();
}

function chart() {
	var datos = {
		reporte : {
			nombreGrafica : "Mexicanos en el mundo",
			subnombre : "Número de mexicanos",
			categories : ["Aguascalientes","Baja California","Baja California Sur","Campeche","Chiapas"],
			ejeYTitulo : "Tiempo",
			unidadesY : 'horas',
			ejeXTitulo : "Menciones",
			unidadesX : 'Ciudadanos',
			valores1 : {
				nombre : "Ciudadanos",
				datos : [349, 239, 560]
			},
			valores2 : {
				nombre : "undef",
				datos : [349, 239, 560]
			}
		}
	}
	var jsonVar;
	var totalMencion = 0;
	var totalTiempo = 0;
	var tmp = datos.reporte;
	var size = datos.reporte.valores1.datos[0].length;
	for ( var i = 0; i < size; i++) {
		totalMencion = totalMencion + parseInt(datos.reporte.valores1.datos[0][i]);
		totalTiempo = totalTiempo + parseInt(datos.reporte.valores2.datos[0][i]);
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
					text : tmp.ejeXTitulo + ': ' + totalMencion + ' | '
							+ tmp.ejeYTitulo + ': ' + totalTiempo,
					style : {
						color : '#2fac66'
					}
				},

				xAxis : [ {
					categories : tmp.categories
				} ],
				labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                },
				yAxis : [ { // Primary yAxis
					labels : {
						formatter : function() {
							return this.value + ' ' + tmp.unidadesY;
						},
						style : {
							color : '#2fac66'
						}
					},
					title : {
						text : tmp.ejeYTitulo,
						style : {
							color : '#2fac66'
						}
					}
				}, { // Secondary yAxis
					title : {
						text : tmp.ejeXTitulo,
						style : {
							color : '#a3195b'
						}
					},
					labels : {
						formatter : function() {
							return this.value + ' ' + tmp.unidadesX;
						},
						style : {
							color : '#a3195b'
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
						stops : [ [ 0, '#b2b2b2' ], [ 1, '#dad8fe' ] ]
					},
					borderWidth : 1,
					borderColor : '#AAA',
					shadow : true,
					style : {
						color : '#000000',
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
					color : '#a3195b',
					type : 'column',
					stack : 'partidos',
					yAxis : 1,
					data : tmp.valores1.datos
				}, {
					name : tmp.ejeYTitulo,
					color : '#2fac66',
					type : 'spline',
					stack : 'tiempos',
					data : tmp.valores2.datos
				} ]
			});
}
/**
 * No usado para este demo
 * @version 0.2
 */
function cmpChange() {
	$("select#paisCmb").change(function() {
		$("div#container").empty();
		$.ajax({
			url : '../src/com.ife.chart.cgi/cgi.php',
			dataType : 'json',
			type : 'POST',
			data : {
				peticion : true,
				action : 'getData',
				idPais : $('select#paisCmb option:selected').val()
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
					keyEstado[int]= response.estado[key[int]];
					
				}
				
				for ( var int = 0; int < key.length; int++) {
					num[int] = parseInt(response.numeros[int]);
					
				}
				chart(keyEstado, num);
				
				
			},
			error : function(response, textStatus, jqXHR) {
				alert(textStatus);
			}
		});
	});
}

function setPaisCombo(){
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
			paisCmb.append(new Option("Selecciona un país"));
			for(var i = 0; i < response.length; i++){
				paisCmb.append(new Option(response[i].nombre, response[i].idPais));
			}
			
		},
		error : function(response, textStatus, jqXHR) {
			alert(textStatus);
		}
	});
	
	
}










/**
 * Dark blue theme for Highcharts JS
 * @author Torstein Hønsi
 */

Highcharts.theme = {
   colors: ["#DDDF0D", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee", 
      "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
   chart: {
      backgroundColor: {
         linearGradient: [0, 0, 250, 500],
         stops: [
            [0, '#dadada'],
            [1, '#dadada']
         ]
      },
      borderColor: '#FFFFFF',
      borderWidth: 0,
      className: 'dark-container',
      plotBackgroundColor: '#b2b2b2',
      plotBorderColor: '#FFFFFF',
      plotBorderWidth: 1,
      plotShadow: true
   },
   title: {
      style: {
         color: '#FFFFFF',
         font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   subtitle: {
      style: { 
         color: '#666666',
         font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   xAxis: {
      
      lineColor: '#A0A0A0',
      tickColor: '#A0A0A0',
      title: {
         style: {
            color: '#CCC',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

         }            
      }
   },
   yAxis: {
      gridLineColor: '#ffffff',
      labels: {
         style: {
            color: '#A0A0A0'
         }
      },
      lineColor: '#ffffff',
      minorTickInterval: null,
      tickColor: '#ffffff',
      tickWidth: 1,
      title: {
         style: {
            color: '#ffffff',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
         }            
      }
   },
   legend: {
      itemStyle: {
         font: '9pt Trebuchet MS, Verdana, sans-serif',
         color: '#A0A0A0'
      }
   },
   tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.75)',
      style: {
         color: '#F0F0F0'
      }
   },
   toolbar: {
      itemStyle: { 
         color: 'silver'
      }
   },
   plotOptions: {
      line: {
         dataLabels: {
            color: '#CCC'
         },
         marker: {
            lineColor: '#333'
         }
      },
      spline: {
         marker: {
            lineColor: '#333'
         }
      },
      scatter: {
         marker: {
            lineColor: '#333'
         }
      },
      candlestick: {
         lineColor: 'white'
      }
   },      
   legend: {
      itemStyle: {
         color: '#CCC'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#444'
      }
   },
   credits: {
      style: {
         color: '#666'
      }
   },
   labels: {
      style: {
         color: '#CCC'
      }
   },
   
   navigation: {
      buttonOptions: {
         backgroundColor: {
            linearGradient: [0, 0, 0, 20],
            stops: [
               [0.4, '#606060'],
               [0.6, '#333333']
            ]
         },
         borderColor: '#000000',
         symbolStroke: '#C0C0C0',
         hoverSymbolStroke: '#FFFFFF'
      }
   },
   
   exporting: {
      buttons: {
         exportButton: {
            symbolFill: '#55BE3B'
         },
         printButton: {
            symbolFill: '#7797BE'
         }
      }
   },
   
   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: {
            linearGradient: [0, 0, 0, 20],
            stops: [
               [0.4, '#888'],
               [0.6, '#555']
            ]
         },
         stroke: '#000000',
         style: {
            color: '#CCC',
            fontWeight: 'bold'
         },
         states: {
            hover: {
               fill: {
                  linearGradient: [0, 0, 0, 20],
                  stops: [
                     [0.4, '#BBB'],
                     [0.6, '#888']
                  ]
               },
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: {
                  linearGradient: [0, 0, 0, 20],
                  stops: [
                     [0.1, '#000'],
                     [0.3, '#333']
                  ]
               },
               stroke: '#000000',
               style: {
                  color: 'yellow'
               }
            }
         }               
      },
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },
   
   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(16, 16, 16, 0.5)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      }
   },
   
   scrollbar: {
      barBackgroundColor: {
            linearGradient: [0, 0, 0, 20],
            stops: [
               [0.4, '#888'],
               [0.6, '#555']
            ]
         },
      barBorderColor: '#CCC',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: {
            linearGradient: [0, 0, 0, 20],
            stops: [
               [0.4, '#888'],
               [0.6, '#555']
            ]
         },
      buttonBorderColor: '#CCC',
      rifleColor: '#FFF',
      trackBackgroundColor: {
         linearGradient: [0, 0, 0, 10],
         stops: [
            [0, '#000'],
            [1, '#333']
         ]
      },
      trackBorderColor: '#666'
   },
   
   // special colors for some of the
   legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
   legendBackgroundColorSolid: 'rgb(35, 35, 70)',
   dataLabelsColor: '#444',
   textColor: '#C0C0C0',
   maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
