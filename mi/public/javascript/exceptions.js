$(document).ready(function() {
// hides the slickbox as soon as the DOM is ready
// (a little sooner than page load)
$('#error_details').hide();

// shows the error_details on clicking the noted link 
$('a#slick-show').click(function() {
$('#error_details').show('slow');
return false;
});

// hides the error_details on clicking the noted link 
$('a#slick-hide').click(function() {
$('#error_details').hide('fast');
return false;
});

// toggles the error_details on clicking the noted link 
$('a#error_details_toggle').click(function() {
$('#error_details').toggle(400);
return false;
});

});
