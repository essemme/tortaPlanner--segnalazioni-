$(document).ready(function(){
    $('body, #sidebar, #main').equalHeight();
	
	$('.message').click(function(){
		$(this).fadeOut();
	});


	// choose text for the show/hide link - can contain HTML (e.g. an image)
	var showText='Mostra';
	var hideText='Nascondi';
	// initialise the visibility check
	var is_visible = false;
	// append show/hide links to the element directly preceding the element with a class of "toggle"
	$('.toggle').prev().append(' <a href="#" class="toggleLink">'+showText+'</a>');
	// hide all of the elements with a class of 'toggle'
	$('.toggle').hide();
        //$('div.toggle').hide();
//        $('div.toggle').click(function(){
//                $('div.toggle a.toggleLink').click();
//        });
	// capture clicks on the toggle links
	$('a.toggleLink').click(function() {
		// switch visibility
		is_visible = !is_visible;
                
		// change the link text depending on whether the element is shown or hidden
		if ($(this).text()==showText) {
			$(this).text(hideText);
			$(this).parent().next('.toggle').slideDown('slow');
		}
		else {
			$(this).text(showText);
			$(this).parent().next('.toggle').slideUp('slow');
		}
		// return false so any link destination is not followed
		return false;
	});
});