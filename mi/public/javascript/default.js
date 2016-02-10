$(document).ready(function() {
// hides the slickbox as soon as the DOM is ready
// (a little sooner than page load)
/* $('#debug_details').hide(); */

// shows the debug_details on clicking the noted link 
$('a#slick-show').click(function() {
$('#debug_details').show('slow');
return false;
});

// hides the debug_details on clicking the noted link 
$('a#slick-hide').click(function() {
$('#debug_details').hide('fast');
return false;
});

// toggles the debug_details on clicking the noted link 
$('a#debug_details_toggle').click(function() {
$('#debug_details').toggle(400);
return false;
});

});

