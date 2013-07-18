$(document).ready(function () {
	$('.vert-nav li').hover(
		function() {
			$('ul', this).slideDown(190);
		},
		function() {
			$('ul', this).slideUp(190);
		}
	);
});