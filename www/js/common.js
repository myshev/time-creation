$(document).ready(function () {
	$('.vert-nav li').hover(
		function() {
			$('ul', this).slideDown(110);
		},
		function() {
			$('ul', this).slideUp(110);
		}
	);
});