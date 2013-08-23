//Javascript that actually calls dygraph and plots it.
//On Table row click the below function gets triggered and plots corresponding graph
$.getScript("../js/dygraph-combined.js");
$('#Farm_prediction').on('click', 'tbody tr', function() {
	var FarmName = $(this).find('td:eq(0)').text();

	jQuery.ajax({
		type : "POST",
		url : "sizeGraph.php",
		data : 'FarmName=' + FarmName,
		cache : false,
		datatype : "text",
		success : function(response) {
			if (response) {
				var res = response;
				$("#outerGraphContainerid").show();
				//Size Graph
				g = new Dygraph(document.getElementById("sizeGraphid"), res, {

					xlabel : 'Date',ylabel:'Size'
				});
			}
		}
	});

	jQuery.ajax({
		type : "POST",
		url : "wpsGraph.php",
		data : 'FarmName=' + FarmName,
		cache : false,
		datatype : "text",
		success : function(response1) {
			if (response1) {
				var res = response1;
				$("#outerGraphContainerid").show();
				//WPS Graph
				g = new Dygraph(document.getElementById("wpsGraphid"), res, {

					xlabel : 'Date',ylabel:'Wps'
				});
			}
		}
	});

});

