/**
 * @author Angel Barrientos
 */
function initEvents(){
	google.load('visualization', '1.0', {
		'packages' : ['imagechart']
	});
	google.setOnLoadCallback(drawChart());
}

/**
 * 
 * 
 */
function creaGrafica(){
	
	
}

function drawChart(){

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
    	['Mushrooms', 3], 
    	['Onions', 1], 
    	['Olives', 1], 
    	['Zucchini', 1], 
    	['Pepperoni', 2],
    	['colado', 5]
    ]);

    // Set chart options
    var options = {
        'title' : 'How Much Pizza I Ate Last Night',
        'width' : 400,
        'height' : 300
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
