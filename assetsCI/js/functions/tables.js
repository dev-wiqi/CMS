$(function() {



	//===== Hide/show sidebar =====//

	$('.fullview').click(function(){
	    $("body").toggleClass("clean");
	    $('#sidebar').toggleClass("hide-sidebar mobile-sidebar");
	    $('#content').toggleClass("full-content");
	});



	//===== Hide/show action tabs =====//

	$('.showmenu').click(function () {
		$('.actions-wrapper').slideToggle(100);
	});



	//===== Autocomplete =====//
	
	var tags = [ "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme" ];
	$( "#autocomplete" ).autocomplete({
		source: tags,
		appendTo: ".autocomplete-append"
	});	

	function setSizes() {
		var containerHeight = $(".autocomplete-append input[type=text]").width();
		$(".autocomplete-append").width(containerWidth - 180);
	};



	//===== Tags =====//	
		
	$('.tags').tagsInput({width:'100%'});
	$('.tags-autocomplete').tagsInput({
		width:'100%',
		autocomplete_url:'tags_autocomplete.html'
	});



	//===== Tooltips =====//

	$('.tip').tooltip();
	$('.focustip').tooltip({'trigger':'focus'});



	//===== Datatables =====//

	oTable = $('#data-table').dataTable({
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": {
			"sSearch": "<span>Filter records:</span> _INPUT_",
			"sLengthMenu": "<span>Show entries:</span> _MENU_",
			"oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
		}
    });



	//===== Fancybox =====//
	
	$(".lightbox").fancybox({
		'padding': 2
	});



	//===== Sparklines =====//
	
	$('#total-visits').sparkline(
		'html', {type: 'bar', barColor: '#ef705b', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false"}
	);
	$('#balance').sparkline(
		'html', {type: 'bar', barColor: '#91c950', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false"}
	);

	$('#visits').sparkline(
		'html', {type: 'bar', barColor: '#ef705b', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false"}
	);
	$('#clicks').sparkline(
		'html', {type: 'bar', barColor: '#91c950', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false"}
	);
	$('#rate').sparkline(
		'html', {type: 'bar', barColor: '#5cb1ec', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false"}
	);
	$(window).resize(function () {
		$.sparkline_display_visible();
	}).resize();


	
	//===== Easy tabs =====//
	
	$('.sidebar-tabs').easytabs({
		animationSpeed: 150,
		collapsible: false,
		tabActiveClass: "active"
	});

	$('.actions').easytabs({
		animationSpeed: 300,
		collapsible: false,
		tabActiveClass: "current"
	});



	//===== Make Google maps visible inaide tabs =====//

	function initialize()
	{
		var mapProp= {
			center: new google.maps.LatLng(-37.814666,144.982452),
			zoom: 12,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		var map=new google.maps.Map(document.getElementById("google-map"),mapProp);

		$('.actions').bind('easytabs:after', function() {
			google.maps.event.trigger(map, 'resize');
			map.setCenter(new google.maps.LatLng(-37.814666,144.982452));
		});

	};
	google.maps.event.addDomListener(window, 'load', initialize);



	//===== Collapsible plugin for main nav =====//
	
	$('.expand').collapsible({
		defaultOpen: 'current,third',
		cookieName: 'navAct',
		cssOpen: 'subOpened',
		cssClose: 'subClosed',
		speed: 200
	});


	//===== Form elements styling =====//
	
	$(".ui-datepicker-month, .styled, .dataTables_length select").uniform({ radioClass: 'choice' });
	
});
