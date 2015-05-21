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




	//===== Generate random values for bars in stats widgets =====//

	function generateNumber(min, max) {
		min = typeof min !== 'undefined' ? min : 1;
		max = typeof max !== 'undefined' ? max : 100;
		return Math.floor((Math.random() * max) + min);
	};

	setInterval(function() {
		$('.info-aapl li span').each(function(index, elem) {
			$(elem).animate({
				height: generateNumber(1, 40)
			});
		});
	}, 3000);




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

	$( ".datepicker" ).datepicker({
				defaultDate: +7,
		showOtherMonths:true,
		autoSize: true,
		appendText: '(dd-mm-yyyy)',
		dateFormat: 'dd-mm-yy'
		});
		
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
	
	$( "#datepicker-icon, .navbar-datepicker" ).datepicker({
		showOn: "button",
		buttonImage: "img/icons/date_picker.png",
		buttonImageOnly: true
	});



	//===== Modals and dialogs =====//

	$("a.bs-alert").click(function(e) {
		e.preventDefault();
		bootbox.alert("Hello world!", function() {
			console.log("Alert Callback");
		});
	});
	
	$("a.confirm").click(function(e) {
		e.preventDefault();
		bootbox.confirm("Are you sure?", function(confirmed) {
			console.log("Confirmed: "+confirmed);
		});
	});
	
	$("a.bs-prompt").click(function(e) {
		e.preventDefault();
		bootbox.prompt("What is your name?", function(result) {
			console.log("Result: "+result);
		});
	});
	
	$("a.dialog").click(function(e) {
		e.preventDefault();
		bootbox.dialog("I am a custom dialog", [{
			"label" : "Success!",
			"class" : "btn-success",
			"callback": function() {
				console.log("great success");
			}
		}, {
			"label" : "Danger!",
			"class" : "btn-danger",
			"callback": function() {
				console.log("uh oh, look out!");
			}
		}, {
			"label" : "Click ME!",
			"class" : "btn-primary",
			"callback": function() {
				console.log("Primary button");
			}
		}, {
			"label" : "Just a button..."
		}, {
			"Condensed format": function() {
				console.log("condensed");
			}
		}]);
	});
	
	$("a.multiple-dialogs").click(function(e) {
		e.preventDefault();

		bootbox.alert("Prepare for multiboxes...", "Argh!");

		setTimeout(function() {
			bootbox.confirm("Are you having fun?", "No :(", "Yeah!", function(result) {
				if (result) {
					bootbox.alert("Glad to hear it!");
				} else {
					bootbox.alert("Aww boo. Click the button below to get rid of all these popups", function() {
						bootbox.hideAll();
					});
				}
			});
		}, 1000);
	});
	
	$("a.dialog-close").click(function(e) {
		e.preventDefault();
		var box = bootbox.alert("This dialog will close in two seconds");
		setTimeout(function() {
			box.modal('hide');
		}, 2000);
	});
	
	$("a.generic-modal").click(function(e) {
		e.preventDefault();
		bootbox.modal('<img src="http://dummyimage.com/600x400/000/fff" alt=""/>', 'Modal popup!');
	});
	
	$("a.dynamic").click(function(e) {
		e.preventDefault();
		var str = $("<p>This content is actually a jQuery object, which will change in 3 seconds...</p>");
		bootbox.alert(str);
		setTimeout(function() {
			str.html("See?");
		}, 3000);
	});
	
	$("a.prompt-default").click(function(e) {
		e.preventDefault();
		bootbox.prompt("What is your favourite JS library?", "Cancel", "OK", function(result) {
			console.log("Result: "+result);
		}, "Bootbox.js");
	});
	
	$("a.onescape").click(function(e) {
		e.preventDefault();
		bootbox.dialog("Dismiss this dialog with the escape key...", {
			"label" : "Press Escape!",
			"class" : "btn-danger",
			"callback": function() {
				console.log("Oi! Press escape!");
			}
		}, {
			"onEscape": function() {
				bootbox.alert("This alert was triggered by the onEscape callback of the previous dialog", "Dismiss");
			}
		});
	});

	$("a.nofade").click(function(e) {
		e.preventDefault();
		bootbox.dialog("This dialog does not fade in or out, and thus does not depend on <strong>bootstrap-transitions.js</strong>.",
		{
			"OK": function() {}
		}, {
			"animate": false
		});
	});

	$("a.nobackdrop").click(function(e) {
		e.preventDefault();
		bootbox.dialog("This dialog does not have a backdrop element",
		{
			"OK": function() {}
		}, {
			"backdrop": false
		});
	});

	$("a.icons-explicit").click(function(e) {
		e.preventDefault();
		bootbox.dialog("Custom dialog with icons being passed explicitly into <b>bootbox.dialog</b>.", [{
			"label" : "Success!",
			"class" : "btn-success",
			"icon"  : "icon-ok-sign icon-white"
		}, {
			"label" : "Danger!",
			"class" : "btn-danger",
			"icon"  : "icon-warning-sign icon-white"
		}, {
			"label" : "<span>Click ME!</span>",
			"class" : "btn-primary",
			"icon"  : "icon-ok icon-white"
		}, {
			"label" : "Just a button...",
			"icon"  : "icon-picture"
		}]);
	});

	$("a.icons-override").click(function(e) {
		e.preventDefault();
		bootbox.setIcons({
			"OK"      : "icon-ok icon-white",
			"CANCEL"  : "icon-ban-circle",
			"CONFIRM" : "icon-ok-sign icon-white"
		});

		bootbox.confirm("This dialog invokes <b>bootbox.setIcons()</b> to set icons for the standard three labels of OK, CANCEL and CONFIRM, before calling a normal <b>bootbox.confirm</b>", function(result) {
			bootbox.alert("This dialog is just a standard <b>bootbox.alert()</b>. <b>bootbox.setIcons()</b> only needs to be set once to affect all subsequent calls", function() {
				bootbox.setIcons(null);
			});
		});
	});

	$("a.no-close-button").click(function(e) {
		e.preventDefault();
		bootbox.dialog("If a button's handler now explicitly returns <b>false</b>, the dialog will not be closed. Note that if anything <b>!== false</b> - e.g. nothing, true, null etc - is returned, the dialog will close.", [{
			"I'll close on click": function() {
				console.log("close on click");
				return true;
			},
		}, {
			"I won't!": function() {
				console.log("returning false...");
				return false;
			}
		}]);
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



    //===== Typeahead =====//

	$('#typeahead').typeahead({
		source: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"],
		appendToBody: false
	});



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





	//===== Popover =====// 

	$('.popover-test').popover({
		placement: 'left'
	})
	.click(function(e) {
		e.preventDefault()
	});

	$("a[rel=popover]")
		.popover()
	.click(function(e) {
		e.preventDefault()
	})




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
