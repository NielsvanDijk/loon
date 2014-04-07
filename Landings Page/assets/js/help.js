$('document').ready(function() {	
	
	var height = $('html').height();
			
	if(height < (window.innerHeight-50)){
		var height = window.innerHeight-100;
	}
	
	$('#landing-page, #landing-overlay').css({
		'height':height
	});
	var selectBox = $("select").selectBoxIt();
});