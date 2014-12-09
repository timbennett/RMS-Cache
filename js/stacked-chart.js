function stackedChart(csv, element, x) {
    d3.csv(csv, function(data) {
        var nvd3Data = csv2nvd3(data, x);
        
        nv.addGraph(function() {
            var chart = nv.models.stackedAreaChart()
                          .margin({right: 100})
                          .x(function(d) { return d[0]; })
                          .y(function(d) { return d[1]; })
                          .useInteractiveGuideline(true)
                          .rightAlignYAxis(true)
                          .transitionDuration(500)
                          .showControls(true)
                          .clipEdge(true);

            //Format x-axis labels with custom function.
            chart.xAxis
                 .tickFormat(function(d) { 
                     return d3.time.format('%X')(new Date(d));
                 });

            chart.yAxis
                 .tickFormat(function(d) { return d3.format('2d')(d) + ' min.'; });

            d3.select(element)
              .datum(nvd3Data)
              .call(chart);

            nv.utils.windowResize(chart.update);

            return chart;
        });
    });
}

// Transforms CSV data from d3 into NVD3 format given an x value key
function csv2nvd3(data, x) {
	var keys = d3.keys(data[0]).filter(function(key) { return key != x; });
	var nvd3Data = keys.map(function(key) {
		return {
			key: key,
			values: data.map(function(datum) {
				return [new Date(datum[x].replace(' ', 'T')), parseFloat(datum[key])];
			}),
		};
	});

	return nvd3Data;
};
