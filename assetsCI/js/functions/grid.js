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



	//===== Time pickers =====//

	$('#defaultValueExample, #time').timepicker({ 'scrollDefaultNow': true });
	
	$('#durationExample').timepicker({
		'minTime': '2:00pm',
		'maxTime': '11:30pm',
		'showDuration': true
	});
	
	$('#onselectExample').timepicker();
	$('#onselectExample').on('changeTime', function() {
		$('#onselectTarget').text($(this).val());
	});
	
	$('#timeformatExample1, #timeformatExample3').timepicker({ 'timeFormat': 'H:i:s' });
	$('#timeformatExample2, #timeformatExample4').timepicker({ 'timeFormat': 'h:i A' });



	//===== Color picker =====//

	$('#cp1').colorpicker({
		format: 'hex'
	});
	$('#cp2').colorpicker();
	$('#cp3').colorpicker();
		var bodyStyle = $('html')[0].style;
	$('#cp4').colorpicker().on('changeColor', function(ev){
		bodyStyle.background = ev.color.toHex();
	});



	//===== Date pickers =====//
		
	$('.inlinepicker').datepicker({
        inline: true,
		showOtherMonths:true
    });

	var dates = $( "#fromDate, #toDate" ).datepicker({
		defaultDate: "+1w",
		changeMonth: false,
		showOtherMonths:true,
		numberOfMonths: 3,
		onSelect: function( selectedDate ) {
			var option = this.id == "fromDate" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
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
	}



	//===== Jquery UI sliders =====//

	$( "#default-slider" ).slider();

	$( "#increments-slider" ).slider({
		value:100,
		min: 0,
		max: 500,
		step: 50,
		slide: function( event, ui ) {
		$( "#donation-amount" ).val( "$" + ui.value );
	}
    });
    $( "#donation-amount" ).val( "$" + $( "#increments-slider" ).slider( "value" ) );

	$( "#range-slider, #range-slider1" ).slider({
		range: true,
		min: 0,
		max: 500,
		values: [ 75, 300 ],
		slide: function( event, ui ) {
			$( "#price-amount, #price-amount1" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
    });
    $( "#price-amount, #price-amount1" ).val( "$" + $( "#range-slider, #range-slider1" ).slider( "values", 0 ) +
      " - $" + $( "#range-slider, #range-slider1" ).slider( "values", 1 ) );

	$( "#slider-range-min, #slider-range-min1" ).slider({
		range: "min",
		value: 37,
		min: 1,
		max: 700,
		slide: function( event, ui ) {
			$( "#min-amount, #min-amount1" ).val( "$" + ui.value );
		}
    });
    $( "#min-amount, #min-amount1" ).val( "$" + $( "#slider-range-min, #slider-range-min1" ).slider( "value" ) );

	$( "#slider-range-max, #slider-range-max1" ).slider({
		range: "max",
		min: 1,
		max: 10,
		value: 2,
		slide: function( event, ui ) {
			$( "#max-amount, #max-amount1" ).val( ui.value );
		}
    });
    $( "#max-amount, #max-amount1" ).val( $( "#slider-range-max, #slider-range-max1" ).slider( "value" ) );



	//===== Select2 dropdowns =====//

	$(".select").select2();



	//===== Tags =====//	
		
	$('.tags').tagsInput({width:'100%'});
	$('.tags-autocomplete').tagsInput({
		width:'100%',
		autocomplete_url:'tags_autocomplete.html'
	});



	//===== Tooltips =====//

	$('.tip').tooltip();
	$('.focustip').tooltip({'trigger':'focus'});



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
