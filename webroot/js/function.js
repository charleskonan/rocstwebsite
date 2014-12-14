/***					***\
	   ANIMATION MENU
\**************************/

jQuery(document).ready(function($) {
    //alert('toto');
    $('#menu-btn').click(function(e){
        e.preventDefault();
        $('body').toggleClass('show-menu');
     })
            
           
});

