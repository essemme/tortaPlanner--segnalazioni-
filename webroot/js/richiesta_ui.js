
/*
 * COMBOBOX per le organizzazioni
 */

	(function( $ ) {
		$.widget( "ui.combobox", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() : "";
				var input = this.input = $( "<input>" )
					.insertAfter( select )
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									if ( $( this ).text().match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									input.data( "autocomplete" ).term = "";
									return false;
								}
							}
						}
					})
					.addClass( "ui-widget ui-widget-content ui-corner-left" );

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				this.button = $( "<button type='button'>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						// close if already visible
						if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
					});
			},

			destroy: function() {
				this.input.remove();
				this.button.remove();
				this.element.show();
				$.Widget.prototype.destroy.call( this );
			}
		});
	})( jQuery );
	
	
	$(function() {
		$( "#EventoOrganizzazioneId" ).combobox();
		$( "#toggle" ).click(function() {
			$( "#EventoOrganizzazioneId" ).toggle();
		});
		
		$( "#EventoPostoId" ).combobox();
	});


	

	
	
	
	/*
	 *  AUTOCOMPLETE multiplo per tags 
	 */

	$(function() {
		
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#EventoTagsList" )
			// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				minLength: 0,
				source: function( request, response ) {
					// delegate back to autocomplete, but extract the last term
					response( $.ui.autocomplete.filter(
						availableTags, extractLast( request.term ) ) );
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
	});
	
	
/*
 * CALENDARIETTO per data evento
 */	

    $(function() {
		$( "#AppuntamentoDataInizio" ).datepicker({dateFormat: 'yy-mm-dd'}, $.datepicker.regional[ "it" ] );
	});


    
    /*
     * Menu correlati per cartelle e files pdf
     */
    $(function() {
    	$("#EventoAddForm").relatedSelects({
	        onChangeLoad: '/eventi/pdf_utente',
	        loadingMessage: 'Sto caricando..',
	        selects: ['cartelle', 'data[Evento][allegato]']
    	});
    	$("#EventoEditForm").relatedSelects({
	        onChangeLoad: '/eventi/pdf_utente',
	        loadingMessage: 'Sto caricando..',
	        selects: ['cartelle', 'data[Evento][allegato]']
    	});
    });
     
    
    
    /*
     * jQuery CAROUSEL per selezione immagine copertina 
     */
    
    
var loadedfirsttime = true;
var theModelCarousel = null;

function modelCarousel_initCallback(carousel) {
	theModelCarousel = carousel;
};

function mycarousel_itemLoadCallback(carousel, state)
{
    // Check if the requested items already exist
    if (carousel.has(carousel.first, carousel.last)) {
        return;
    }
   
    
    jQuery.get(
        '/eventi/immagini_utente/'+ carousel.first + '/'+ carousel.last,
        {
            first: carousel.first,
            last: carousel.last
        },
        function(xml) {
            mycarousel_itemAddCallback(carousel, carousel.first, carousel.last, xml);
        },
        
        'xml'
       
    );
    
    if(carousel.size > 5 && carousel.last <  carousel.size) {
    	$("jcarousel-next-horizontal").attr('class','jcarousel-next jcarousel-next-horizontal').attr('disabled').remove();
    }
};

function mycarousel_itemAddCallback(carousel, first, last, xml)
{
    // Set the size of the carousel
    carousel.size(parseInt(jQuery('total', xml).text()));

    jQuery('image', xml).each(function(i) {
        carousel.add(first + i, mycarousel_getItemHTML(jQuery(this).text()));
       
    });
};

/**
 * Item html creation helper.
 */
function mycarousel_getItemHTML(url)
{
    return '<img src="' + url + '" width="75" height="75" alt="" style="cursor:pointer;" />';
};


jQuery(window).load(function() {

	$('#immagini').click(function (e) {
		if($(e.target).is("img")) {   
		var img_source = $(e.target).attr('src'); 
 		$("#show_image").html('<img src="'+ img_source + '">');	
 		$("#EventoImmagine").val(img_source);
		}
	});
    
	
    jQuery('#immagini').jcarousel({
        // Uncomment the following option if you want items
        // which are outside the visible range to be removed
        // from the DOM.
        // Useful for carousels with MANY items.

//        itemVisibleOutCallback: {onAfterAnimation: function(carousel, item, i, state, evt) { carousel.remove(i); }},
        initCallback : modelCarousel_initCallback,
	    itemLoadCallback: mycarousel_itemLoadCallback        
    });



	$('#image_toggle').click(function() {
		  $('#image_choiche').toggle('slow');
		  loadedfirsttime = false;
	});			
	if(loadedfirsttime) {
		$('#image_choiche').hide('fast');
	}
	
});


/*
 * PLUPLOAD component per caricare immagini
 */

	
	// Convert divs to queue widgets when the DOM is ready
	//var uploader = new plupload.Uploader();

	jQuery(document).ready(function() {
	//$(function() {
		$("#uploader").pluploadQueue({
					
			runtimes : 'gears,flash,silverlight,browserplus',
			url : '/js/plupload/js/upload.php?f='+user_id,
			max_file_size : '2mb',
			chunk_size : '1mb',
			unique_names : false,
			max_file_count: 10, // user can add no more then 20 files at a time
			multiple_queues : true,
			// Rename files by clicking on their titles
			rename: true,
			
			// Sort files
			sortable: true,
			
			// Resize images on clientside if we can
			resize : {width : 250, height : 500, quality : 90},


			// Specify what files to browse for
			filters : [
				{title : "Image files", extensions : "jpg,gif,png"},
				{title : 'PDF files', extensions : 'pdf'}
			],

					
			// Flash settings
			flash_swf_url : baseUrl+ 'js/plupload/js/plupload.flash.swf',

			// Silverlight settings
			silverlight_xap_url : baseUrl+ 'js/plupload/js/plupload.silverlight.xap',

			init : {
				'UploadComplete' : function(up) {
							theModelCarousel.reset();
							// theModelCarousel.mycarousel_itemLoadCallback(theModelCarousel, 'reset');
				           }
			}
		});
		
	});
	
	
/*
 * MAP -- per luogo / indirizzo di svolgimento
 */
      
var geocoder;
var map;
var marker;
    
function initialize(){
//MAP
  var latlng = new google.maps.LatLng(44.8378942,11.6204396);
  var options = {
    zoom: 15,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.HYBRID
  };
        
  map = new google.maps.Map(document.getElementById("map_canvas"), options);
        
  //GEOCODER
  geocoder = new google.maps.Geocoder();
        
  marker = new google.maps.Marker({
    map: map,
    draggable: true
  });
  
//  google.maps.event.trigger(map, 'resize');
}
		
$(window).load(function() {

  initialize();
				  
  $(function() {
    $("#PostoIndirizzo").autocomplete({
      //This bit uses the geocoder to fetch address values
      source: function(request, response) {
        geocoder.geocode( {'address': request.term, 'region': 'it' }, function(results, status) {
          response($.map(results, function(item) {
            return {
              label:  item.formatted_address,
              value: item.formatted_address,
              latitude: item.geometry.location.lat(),
              longitude: item.geometry.location.lng()
            }
          }));
        })
      },
      //This bit is executed upon selection of an address
      select: function(event, ui) {
        $("#PostoLat").val(ui.item.latitude);
        $("#PostoLon").val(ui.item.longitude);
        var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
        marker.setPosition(location);
        map.setCenter(location);
      }
    });
  });
	
  //Add listener to marker for reverse geocoding
  google.maps.event.addListener(marker, 'drag', function() {
    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          $('#PostoIndirizzo').val(results[0].formatted_address);
          $('#PostoLat').val(marker.getPosition().lat());
          $('#PostoLon').val(marker.getPosition().lng());
        }
      }
    });
  });
  
});


$(function() {
//	non serve, se è un edit l'organizzazione c'è già.. 
//	quale_tab = $( "#nuova_organizzazione").val();		
//	$( "#accordion" ).accordion({ active: quale_tab });

	$( "#accordion" ).accordion();
	
	$( "#nuova_organizzazione").click( function () {
		$( "#EventoNuovaOrganizzazione" ).val(1);
	}
	);	
	$( "#presente").click( function () {
		$( "#EventoNuovaOrganizzazione" ).val(0);
		}
	);	
	
	
	$( "#luogo_accordion" ).accordion();	
	//google.maps.event.trigger(map, 'resize');
	

	$( "#nuovo_luogo").click( function () {
		$( "#EventoNuovoLuogo" ).val(1);
		google.maps.event.trigger(map, 'resize');
	}
	);	
	$( "#luogo_presente").click( function () {
		$( "#EventoNuovoLuogo" ).val(0);
		}
	);	
	
});