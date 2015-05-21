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


	//===== Validation engine =====//
	
	$("#validate").validationEngine({promptPosition : "topRight:-122,-5"});



	//===== Dual select boxes =====//
	
	$.configureBoxes();



	//===== Date pickers =====//
		
	$('.inlinepicker').datepicker({
        inline: true,
		showOtherMonths:true
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



	//===== Loading button =====//

    $('#loading').click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        }, 3000);
	});



	//===== Spinner options =====//
	
	$( "#spinner-default" ).spinner();
	
	$( "#spinner-decimal" ).spinner({
		step: 0.01,
		numberFormat: "n"
	});
	
	$( "#culture" ).change(function() {
		var current = $( "#spinner-decimal" ).spinner( "value" );
		Globalize.culture( $(this).val() );
		$( "#spinner-decimal" ).spinner( "value", current );
	});
	
	$( "#currency" ).change(function() {
		$( "#spinner-currency" ).spinner( "option", "culture", $( this ).val() );
	});
	
	$( "#spinner-currency" ).spinner({
		min: 5,
		max: 2500,
		step: 25,
		start: 1000,
		numberFormat: "C"
	});
		
	$( "#spinner-overflow" ).spinner({
		spin: function( event, ui ) {
			if ( ui.value > 10 ) {
				$( this ).spinner( "value", -10 );
				return false;
			} else if ( ui.value < -10 ) {
				$( this ).spinner( "value", 10 );
				return false;
			}
		}
	});
	
	$.widget( "ui.timespinner", $.ui.spinner, {
		options: {
			// seconds
			step: 60 * 1000,
			// hours
			page: 60
		},

		_parse: function( value ) {
			if ( typeof value === "string" ) {
				// already a timestamp
				if ( Number( value ) == value ) {
					return Number( value );
				}
				return +Globalize.parseDate( value );
			}
			return value;
		},

		_format: function( value ) {
			return Globalize.format( new Date(value), "t" );
		}
	});

	$( "#spinner-time" ).timespinner();
	$( "#culture-time" ).change(function() {
		var current = $( "#spinner-time" ).timespinner( "value" );
		Globalize.culture( $(this).val() );
		$( "#spinner-time" ).timespinner( "value", current );
	});



	//===== Select2 dropdowns =====//

	$(".select").select2();
				
	$("#loading-data").select2({
		placeholder: "Enter at least 1 character",
        allowClear: true,
        minimumInputLength: 1,
        query: function (query) {
            var data = {results: []}, i, j, s;
            for (i = 1; i < 5; i++) {
                s = "";
                for (j = 0; j < i; j++) {s = s + query.term;}
                data.results.push({id: query.term + i, text: s});
            }
            query.callback(data);
        }
    });		

	$("#max-select").select2({ maximumSelectionSize: 3 });		

	$("#clear-results").select2({
	    placeholder: "Select a State",
	    allowClear: true
	});

	$("#min-select2").select2({
        minimumInputLength: 2
    });
	
	$("#disableselect, #disableselect2").select2(
        "disable"
    );

	$("#minimum-input-single").select2({
	    minimumInputLength: 2
	});



	//===== Tags =====//	
		
	$('.tags').tagsInput({width:'100%'});
	$('.tags-autocomplete').tagsInput({
		width:'100%',
		autocomplete_url:'tags_autocomplete.html'
	});



	//===== Input limiter =====//
	
	$('.limited').inputlimiter({
		limit: 100,
		boxId: 'limit-text',
		boxAttach: false
	});



	//===== Elastic textarea =====//
	
	$('.auto').autosize();



	//===== Tooltips =====//

	$('.tip').tooltip();
	$('.focustip').tooltip({'trigger':'focus'});



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
